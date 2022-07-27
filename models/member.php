<!-- models/member.php -->

<?php
class Member
{
  public $id;
  public $username;
  public $password;
  public $fullname;
  public $email;
  public $birthday;
  public $gender;

  function __construct($id, $fullname, $email, $birthday, $gender)
  {
    $this->id = $id;
    $this->fullname = $fullname;
    $this->email = $email;
    $this->birthday = $birthday;
    $this->gender = $gender;
  }

  static function all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM members');

    foreach ($req->fetchAll() as $item) {
      $list[] = 
      new Member($item['id'], $item['fullname'], $item['email'], $item['birthday'], $item['gender']);
    }

    return $list;
  }

  static function find($id)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM members WHERE id = :id');
    $req->execute(array('id' => $id));

    $item = $req->fetch();
    if (isset($item['id'])) {
      return new Member($item['id'], $item['fullname'], $item['email'], $item['birthday'], $item['gender']);
    }
    return null;
  }
}
