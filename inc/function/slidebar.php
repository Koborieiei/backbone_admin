<?php
  session_start();
  include('connect.php');
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  $baseurl = "/newEdbot2/admin/pages/";
  $REQUEST_URI = $_SESSION['RE_URI'];

  //print_r($_SESSION['member'][0]);
  $MEMBER = $_SESSION['member'][0];

  if(empty($MEMBER['role_list']) && $MEMBER['role_list'] != 0){
    exit("<script>window.location='../../pages/login/'</script>");
  }


  $module_idPage = "";

  $sqlu = "SELECT GROUP_CONCAT(DISTINCT page_list ORDER BY page_list ASC SEPARATOR ',') as page_list,
                  GROUP_CONCAT(DISTINCT role_code ORDER BY role_code ASC SEPARATOR ',') as role_code
                  FROM t_role WHERE role_id IN ({$MEMBER['role_list']})";
  //echo $sqlu;
  $queryu = DbQuery($sqlu,null);
  $rows   = json_decode($queryu, true);
  $rowu   = $rows['data'];
  $dataCount   = $rows['dataCount'];
  $strPage = '';

  if($dataCount > 0)
  {
     $strPage   = $rowu[0]['page_list'];
     $roleCode  = $rowu[0]['role_code'];
      //echo $role_code;
    if(strpos($roleCode,"HOF") !== false && false)
    {
      $sqlb   = "SELECT * FROM t_branch WHERE is_active = 'Y'";
      $queryb = DbQuery($sqlb,null);
      $jsonb  = json_decode($queryb, true);
      $rowb   = $jsonb['data'];
      $dCount  = $jsonb['dataCount'];
      if($dCount > 0)
      {
          //echo $_SESSION['branchCode'];
        ?>
          <div class="form-group" style="margin:5px;">
            <select class="form-control" onchange="changeBranch()" id="branchCodeSlidebar" >
         <?php
        foreach ($rowb as $k => $value)
        {
          $selected = "";

          if($_SESSION['branchCode'] == $value['branch_code'])
          {
            $selected =  'selected="selected"';
          }
        ?>
            <option value="<?= $value['branch_code'] ?>" <?= $selected?>><?= $value['cname'] ?></option>
        <?php
        }
         ?>
          </select>
        </div>
        <?php
      }
    }
    if($strPage != "")
    {
    $strArr = explode("/",$REQUEST_URI);
    $inx    = count($strArr) - 2;
    //$page_path = substr(str_replace($baseurl,'',$REQUEST_URI) , 0,-1);
    $page_path = $strArr[$inx];

    $arrPage = array_unique(explode(",",$strPage));
    sort($arrPage);
    $arrPage = implode(",",$arrPage);

    $sqlp = "SELECT p.*,m.root_id,m.module_name,m.module_icon,r.root_name
             FROM t_page p , t_module m , t_root r
             WHERE p.page_id IN ($arrPage) AND p.is_active = 'Y'
             AND m.module_type = '1' AND m.is_active = 'Y' AND p.module_id = m.module_id
             AND m.root_id = r.root_id
             order by r.root_seq, m.module_order,p.page_seq";
    $queryp = DbQuery($sqlp,null);
    $rows   = json_decode($queryp, true);
    $rowp   = $rows['data'];
    $strRoot = '';
    $arrData = array();
    $arrRoot = array();
    $strs = '';
    //echo $sqlp;
    foreach ($rowp as $k => $value)
    {
      $module_id  = $value['module_id'];
      $root_id    = $value['root_id'];
      $page_id    = $value['page_id'];
      $pagePath   = $value['page_path'];

      $strs     .= " ".$page_path;
      if($page_path == $pagePath){
        $module_idPage = $module_id;
      }
      $arrRoot[$root_id]['root_name'] = $value['root_name'];
      $arrData[$root_id][$module_id]["module_name"] = $value['module_name'];
      $arrData[$root_id][$module_id]["module_icon"] = $value['module_icon'];
      $arrData[$root_id][$module_id]["page"][$page_id] = $value;
    }

  // check Page Role
  $pagess = substr( str_replace($baseurl,"",$REQUEST_URI),0,-1 );
  $pos = strrpos($strs, $pagess);

  if ($pos === false) {
    //exit("<script>alert('ไม่มีสิทธิ์ใช้งาน');window.history.back();</script>");
  }
  // End Function  //

  foreach ($arrRoot as $key => $valueRoot)
  {
      $root_id = $key;
  ?>
<li class="header"><?=$valueRoot['root_name']?></li>
<?php
    foreach ($arrData[$root_id] as $module_id => $valueModule)
    {
      $countPage    = count($valueModule["page"]);
        if($countPage == 1)
        {
        ?>
        <li class="<?=$module_id==$module_idPage?"active":""?>">
          <?php
              foreach ($valueModule["page"] as $kay => $value) {
          ?>
          <a href="../<?=$value["page_path"]?>/">
            <i class="<?=$valueModule["module_icon"]?>"></i>
            <span><?=$valueModule["module_name"]?></span>
          </a>
          <?php }?>
        </li>
        <?php
        }else{
        ?>
        <li class="treeview <?=$module_id==$module_idPage?"active menu-open":""?>">
        <a href="#">
          <i class="<?=$valueModule["module_icon"]?>"></i>
          <span><?=$valueModule["module_name"]?></span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php
              foreach ($valueModule["page"] as $kay => $value) {
          ?>
          <li class="<?=$page_path==$value['page_path']?"active":""?>"><a href="../<?=$value['page_path']?>/"><i class="<?=$value['page_icon'];?>"></i><?=$value['page_name']?></a></li>
          <?php } ?>
        </ul>
        </li>
        <?php
        }
    }
    }
  }
}
  ?>
