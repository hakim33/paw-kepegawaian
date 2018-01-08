<?php
    require_once "PHPUnit/src/Framework/TestCase.php"
    class login extends PHPUnit_Framework_TestClass
    {

    public function login(Request $r){
      $datas = account::where("username",strip_tags($r->username))->get();
      if(count($datas)>0){
        foreach ($datas as $data);
        if($data->username == strip_tags($r->username) && 
           Hash::check(strip_tags($r->password),$data->password)){
          $datas = employee::select("employees.nip","nama","jabatan")
                  ->join("accounts","accounts.nip","=","employees.nip")
                  ->where("username",strip_tags($r->username))->get();
          if(count($datas)>0){
            foreach ($datas as $data);
            $_SESSION["username"] = $r->username;
            $_SESSION["nip"] = $data->nip;
            $_SESSION["nama"] = $data->nama;
            $_SESSION["jabatan"] = strtolower($data->jabatan);
            if($_SESSION["jabatan"]=="manager"){
              echo "<script>window.location.href='admin'</script>";
            }else{
              echo "<script>window.location.href='pegawai'</script>";
            }
          }
        }
      }
    }
  }
?>