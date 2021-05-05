  <?php
  session_start();
  include('../../../inc/function/connect.php');
  include('../../../inc/function/mainFunc.php');
  header("Content-type:text/html; charset=UTF-8");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);

  ?>

  <table class="table table-bordered table-striped" id="tableDisplay">
    <thead>
      <tr class="text-center">
        <td>No</td>
        <td>ชื่อไฟล์</td>
        <td>Link URL</td>
        <td>Del</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $role_list= $_SESSION['member'][0]['role_list'];
        $user_id= $_SESSION['member'][0]['user_id'];
        $str    = $role_list==0?"":"WHERE user_id = '$user_id'";
        $sqls   = "SELECT * FROM upload_file $str ORDER BY uf_id DESC";
        $querys = DbQuery($sqls,null);

        $json   = json_decode($querys, true);
        $counts = $json['dataCount'];
        $rows   = $json['data'];

        if($counts > 0){
          foreach ($rows as $key => $value) {


            $url = str_replace("admin/pages/uploadfile/ajax/showTable.php","image/upload/","https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$value['uf_url']);

      ?>
      <tr class="text-center">
        <td><?=$key+1;?></td>
        <td class="text-left"><?=$value['uf_name'];?></td>
        <td>
          <input type="text" class="none-input" value="<?=$url?>" id="url_<?=$value['uf_id']?>" readonly>
        </td>
        <td>
          <a href="../../../image/upload/<?=$value['uf_url'];?>" download class="btn btn-info btn-sm btn-flat"><span class="glyphicon glyphicon-save"></span></a>
          <button type="button" class="btn btn-success btn-sm btn-flat" onclick="CopyMessage('url_<?=$value['uf_id']?>')">Copy</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" onclick="delModule('<?=$value['uf_id']?>')">Del</button>
        </td>
      </tr>
      <?php } }?>
    </tbody>
  </table>
  <script>
    $(function () {
      $('#tableDisplay').DataTable();
    })
  </script>
