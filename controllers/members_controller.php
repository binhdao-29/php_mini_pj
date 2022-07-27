<!-- controllers/members_controller.php -->

<?php
require_once('controllers/base_controller.php');
require_once('models/member.php');

class MembersController extends BaseController
{
  function __construct()
  {
    $this->folder = 'members';
  }

  public function index()
  {
    $members = Member::all();
    $data = array('members' => $members);
    $this->render('index', $data);
  }

  public function showMember()
  {
    $member = Member::find($_GET['id']);
    $data = array('member' => $member);
    $this->render('show', $data);
  }
}
