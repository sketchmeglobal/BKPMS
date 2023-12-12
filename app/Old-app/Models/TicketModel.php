<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ticket_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



  public function getMyTickets($emp_id) {
    $tickets_rs = $this->db->table('ticket_details')
        ->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.created_on, ticket_details.created_by, ticket_details.ticket_status, ticket_status_master.ticket_status_id, ticket_status_master.ticket_status_name, master_severity.id as id, master_severity.ticket_severity_name, master_ticket_category.ticket_category_name, master_employee.emp_name, master_employee.email_id, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.status_history')
        ->join('master_severity', 'master_severity.id = ticket_details.ticket_severity')
        ->join('master_ticket_category', 'master_ticket_category.id = ticket_details.ticket_category')
        ->join('master_employee', 'master_employee.id = ticket_details.created_by')
        ->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')
        ->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')
        ->where([
            'ticket_details.created_by' => $emp_id, //own created tickets
            'ticket_details.row_status' => 1, //active
        ])
        ->orderBy('ticket_details.ticket_id', 'DESC')
        ->limit(100)
        ->get()->getResult();

    return $tickets_rs;
  }

  public function getTopicMaster(){
    $topic_rows = $this->db->table('master_ticket_topic')->where(['row_status' => 1])->get()->getResult();      
    return $topic_rows;
  }//end function

  public function getCategoryMaster(){
    $category_rows = $this->db->table('master_ticket_category')->where(['row_status' => 1])->get()->getResult();
    return $category_rows;
  }//end function

  public function getCategoryMasterByTopicId($topic_id){
    
    $category_rows = $this->db->table('master_ticket_category')
        ->where(['row_status' => 1, 'topic_id' => $topic_id])
        ->get()->getResult();
    return $category_rows;

  }

  public function getSolutionByCategoryId($ticket_category_id){
      $solution_rows = $this->db->table('master_ticket_solution')
          ->where(['row_status' => 1, 'ticket_category_id' => $ticket_category_id])
          ->get()->getResult();
      return $solution_rows;
  }

  public function insertTableData($validatedData){
    $status = true;
    $return_data = array();
    
    $topic_id = $validatedData['topic_id'];
    $ticket_category = $validatedData['ticket_category'];
    $ticket_subject = $validatedData['ticket_subject'];
    $ticket_description = $validatedData['ticket_description'];
    $self_assign = $validatedData['self_assign'];
    $self_assign_msg = $validatedData['self_assign_msg'];
    $created_by = $validatedData['created_by'];
    $ol_id = $validatedData['ol_id'];
    ($self_assign == 'Yes') ? $ticket_status=2 : $ticket_status=1 ;
//      print_r($validatedData);die();

    $ticket_severity = $this->db->table('master_ticket_category ')->where('id',$ticket_category)->get()->getRow()->ticket_severity_id;

    $fields_array = [
      'ticket_severity' => $ticket_severity,
      'topic_id' => $topic_id,
      'ticket_category' => $ticket_category,
      'ticket_subject' => $ticket_subject,
      'ticket_description' => $ticket_description,
      'ticket_status' => $ticket_status,
      'created_by' => $created_by,
      'ol_id' => $ol_id
    ];
    //insert query
    $this->db->table('ticket_details')->insert($fields_array);
    $ticket_id = $this->db->insertID();

    //if new ticket inserted
    if($ticket_id > 0){
      $update_array = [
        'ticket_number' => TICKET_PREFIX.$ticket_id,
      ];
      $this->db->table('ticket_details')->update($update_array, ['ticket_id' => $ticket_id]);

      //insert into ticket comments table
        $status_history = $comment_description = [];
        $emp_name = $this->db->table('master_employee')->where('id',$created_by)->get()->getRow()->emp_name;
        $emp_email_id = $this->db->table('master_employee')->where('id',$created_by)->get()->getRow()->email_id;
        $status_name = $this->db->table('ticket_status_master')->where('ticket_status_id',2)->get()->getRow()->ticket_status_name;

        if($self_assign == 'Yes'){
            $insert_array['accepted_by'] = $created_by;
            $insert_array['accepted_by_name'] = $emp_name;
            $insert_array['accepted_at'] = date('Y-m-d H:i:s');

            $add_status_history['obj_id'] = rand(1000, 9999);
            $add_status_history['new_status'] = 2;
            $add_status_history['new_status_text'] = $status_name;
            $add_status_history['updated_by'] = $created_by;
            $add_status_history['updated_by_name'] = $emp_name;
            $add_status_history['updated_on'] = date('Y-m-d H:i:s');
            $add_status_history['custom_msg'] = "Ticket is self-assigned.";
            array_push($status_history, $add_status_history);

            $add_comment_description['obj_id'] = rand(1000, 9999);
            $add_comment_description['reply_text'] = '<b>Reason of self-assignment:</b> '.$self_assign_msg;
            $add_comment_description['replied_by'] = $created_by;
            $add_comment_description['emp_name'] = $emp_name;
            $add_comment_description['email'] = $emp_email_id;
            $add_comment_description['replied_at'] = date('Y-m-d H:i:s');
            array_push($comment_description, $add_comment_description);
        }
      $insert_array['ticket_id'] = $ticket_id;
      $insert_array['status_history'] = json_encode($status_history);
      $insert_array['comment_description'] = json_encode($comment_description);
      $this->db->table('ticket_comments')->insert($insert_array);

      $status = true;  
    }else{
      $status = false;
    }

    $return_data['ticket_id'] = $ticket_id;
    $return_data['status'] = $status;
    return $return_data;
  }

  // view ticket area
  public function getTicketDetails($ticket_id) {
        $hw_rows = $this->db->table('ticket_details')
            ->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.hw_sl_id, ticket_details.sr_reason_msg, ticket_details.authority_cc, ticket_details.ticket_description, ticket_details.created_by, ticket_details.ticket_status, ticket_details.created_on, ticket_details.emp_gr_id, master_severity.ticket_severity_name, master_severity.id, master_severity.max_allowed_time, master_ticket_category.ticket_category_name, ticket_status_master.ticket_status_id, ticket_status_master.ticket_status_name, master_employee.emp_name, master_employee.email_id, ticket_comments.comment_description, ticket_comments.status_history, ticket_comments.accepted_by, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.last_updated')
            ->join('master_severity', 'master_severity.id = ticket_details.ticket_severity')
            ->join('master_ticket_category', 'master_ticket_category.id = ticket_details.ticket_category')
            ->join('master_employee', 'master_employee.id = ticket_details.created_by')
            ->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')
            ->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')
            ->where(['ticket_details.ticket_id' => $ticket_id])
            ->get()->getResult();

        return $hw_rows[0];
    }//end function 

    public function getTicketStatus() {
        $tic_stat_rows = $this->db->table('ticket_status_master')->where(['row_status' => 1])->get()->getResult();
        return $tic_stat_rows;
    }//end function  

    public function getHolidayList() {
        $holiday_list = $this->db->table('master_holiday_list')->where(['row_status' => 1])->get()->getResult();
        return $holiday_list;
    }//end function

    public function getAllEmpGroup() {
        $rows = $this->db->table('master_employee_group')->where(['row_status' => 1])->limit(100)->get()->getResult();
        return $rows;
    }//end function
  
    public function getIssuedDevices() {
      $rows = $this->db->table('hardware_serial')
          ->select('hardware_serial.hw_sl_id,hardware_serial.serial_no,hardware_serial.deviceMetaData, master_hardware_category.hw_name,master_hardware_category.hw_code')
          ->join('master_hardware_category','master_hardware_category.id = hardware_serial.hw_id','left')
          ->where(['issued' => 1, 'returned' => 0, 'hardware_serial.row_status' => 1])
          ->get()->getResult();
      return $rows;
  }

  public function getTicketSolutions($ticket_id) {
      $ticket_category_id = $this->db->table('ticket_details')->where('ticket_id', $ticket_id)->get()->getRow()->ticket_category;
      $solution_rows = $this->db->table('master_ticket_solution')
          ->where(['row_status' => 1, 'ticket_category_id' => $ticket_category_id])
          ->get()->getResult();
      return $solution_rows;
  }

  public function insertTableData_view($validatedData){
        $status = true;
        $return_data = array();
        $ticket_comment_id = 0;
        $comment_description = array();
        $message = '';

        $ticket_id = $validatedData['ticket_id'];
        $reply_text = $validatedData['reply_text'];
        $replied_by = $validatedData['replied_by'];
        $emp_name = $validatedData['emp_name'];
        $email = $validatedData['email'];


        $comment_description_obj = new \stdClass;
        $comment_description_obj->obj_id = rand(1000, 9999);
        $comment_description_obj->reply_text = $reply_text;
        $comment_description_obj->replied_by = $replied_by;
        $comment_description_obj->emp_name = $emp_name;
        $comment_description_obj->email = $email;
        $comment_description_obj->replied_at = date('d-m-Y H:i:s');

        //duplicate checking
        $row = $this->db->table('ticket_comments')->select('*')->where(['ticket_id' => $ticket_id])->get()->getResult();

        $arr_size = sizeof($row);
        if ($arr_size > 0) {
            $comment_description1 = $row[0]->comment_description;
            $comment_description = json_decode($comment_description1);
            array_push($comment_description, $comment_description_obj);

            $update_array = [
                'comment_description' => json_encode($comment_description)
            ];
            //update query
            $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);
            $status = true;
            $message = 'Reply saved successfully';

        } else {
            //insert query
            array_push($comment_description, $comment_description_obj);
            $insert_array = [
                'ticket_id' => $ticket_id,
                'comment_description' => json_encode($comment_description)
            ];

            $this->db->table('ticket_comments')->insert($insert_array);
            $ticket_comment_id = $this->db->insertID();
            if ($ticket_comment_id > 0) {
                $status = true;
            } else {
                $status = false;
                $message = 'Insert Query Problem';
            }
        }//end if

        $return_data['ticket_comment_id'] = $ticket_comment_id;
        $return_data['status'] = $status;
        $return_data['message'] = $message;
        return $return_data;
  }


  public function acceptTicket($parent_emp_code, $post_data){
    $status = true;
    $deadline = '';
    $return_data = array();

    $ticket_id = $post_data['ticket_id'];
    $created_by = $post_data['created_by'];
    $ticket_status_id = $post_data['ticket_status_id'];
    $ticket_status_text = $post_data['ticket_status_text'];
    $max_allowed_time = $post_data['max_allowed_time'];
    $emp_gr_id = $post_data['emp_gr_id'];
    $emp_gr_text = $post_data['emp_gr_text'];
    $hw_sl_id = $post_data['hw_sl_id'];
    $hw_text = $post_data['hw_text'];
    $sr_req_msg = $post_data['sr_req_msg'];
    $accepted_by = $post_data['accepted_by'];
    $accepted_by_name = $post_data['accepted_by_name'];
    $accepted_at = date('Y-m-d H:i:s');

    //get the employee_id of the immediate boss, of the ticket creator
    $creator_parent_emp_code = $this->db->table('master_employee')->where(['id' => $created_by])->get()->getRow()->parent_emp_code;
    $creator_parent_emp_id = $this->db->table('master_employee')->where(['emp_code' => $creator_parent_emp_code])->get()->getRow()->id;
    if ($accepted_by != '') {
        //get the employee_id of the immediate boss, of the service engineer (who accepted the ticket)
        $acceptor_parent_emp_code = $this->db->table('master_employee')->where(['id' => $accepted_by])->get()->getRow()->parent_emp_code;
        $acceptor_parent_emp_id = $this->db->table('master_employee')->where(['emp_code' => $acceptor_parent_emp_code])->get()->getRow()->id;
        //get the employee_id of the 2nd immediate boss, of the service engineer (who accepted the ticket)
        $acceptor_2nd_parent_emp_code = $this->db->table('master_employee')->where(['id' => $acceptor_parent_emp_id])->get()->getRow()->parent_emp_code;
        $acceptor_2nd_parent_emp_id = $this->db->table('master_employee')->where(['emp_code' => $acceptor_2nd_parent_emp_code])->get()->getRow()->id;
    }

    //fetch old status history
    $row = $this->db->table('ticket_comments')->select('*')->where(['ticket_id' => $ticket_id])->get()->getRow();
    $status_history = json_decode($row->status_history);
    //add status details
    $add_status_history['obj_id'] = rand(1000, 9999);
    $add_status_history['new_status'] = $ticket_status_id;
    $add_status_history['new_status_text'] = $ticket_status_text;
    // print_r(session('emp_id')); die('dead');
    $add_status_history['updated_by'] = session('emp_id');
    $add_status_history['updated_by_name'] = session('emp_name');
    $add_status_history['updated_on'] = date('Y-m-d H:i:s');

    #update ticket_comments table
    //In-Progress
    if ($ticket_status_id == 2) {
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = [
            'accepted_by' => session('emp_id'),
            'accepted_by_name' => session('emp_name'),
            'accepted_at' => $accepted_at,
            'status_history' => json_encode($status_history)
        ];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update delegate group
        $this->db->table('ticket_details')->set('emp_gr_id', null)->where('ticket_id', $ticket_id)->update();
        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

        //calculation of max allowed time to complete the task
        $temp_deadline = date('Y-m-d H:i:s', strtotime($accepted_at . ' + ' . $max_allowed_time . ' hours'));
        $temp_deadline = date('Y-m-d H:i:s', strtotime($temp_deadline . ' - ' . '24 hours'));
        $holiday_list = $this->db->table('master_holiday_list')->select('*')->where(['row_status' => 1])->get()->getResult();
        $holidayCount = 0;
        for ($x = 0; $x < sizeof($holiday_list); $x++) {
            if ($holiday_list[$x]->hl_date > $accepted_at && $holiday_list[$x]->hl_date <= $temp_deadline) {
                $holidayCount++;
            }
        }
        $max_allowed_time = $max_allowed_time + ($holidayCount * 24);
        $deadline = date('Y-m-d H:i:s', strtotime($accepted_at . ' + ' . $max_allowed_time . ' hours'));
    }
    //Delegated
    elseif ($ticket_status_id == 8) {
        $add_status_history['custom_msg'] = 'Ticket delegated to <b>'.$emp_gr_text.'</b>';
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = ['status_history' => json_encode($status_history)];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update delegate group
        $this->db->table('ticket_details')->update(['emp_gr_id' => $emp_gr_id], ['ticket_id' => $ticket_id]);
        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);
    }
    //SR Requested
    elseif ($ticket_status_id == 5) {
        $add_status_history['custom_msg'] = '<b>Device Serial No:</b> '.$hw_text.'<br/><b>Reason for SR:</b> '.$sr_req_msg;
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = ['status_history' => json_encode($status_history)];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

        //update device serial & reason for SR
        $this->db->table('ticket_details')->update(['hw_sl_id' => $hw_sl_id,'sr_reason_msg' => $sr_req_msg], ['ticket_id' => $ticket_id]);

        #send for SR approval
        //get the employee_id of the immediate boss, of the ticket creator
        $creator_parent_emp_code = $this->db->table('master_employee')->where(['id' => $created_by])->get()->getRow()->parent_emp_code;
        $creator_parent_emp_id = $this->db->table('master_employee')->where(['emp_code' => $creator_parent_emp_code])->get()->getRow()->id;
        //insert SR approval route
        $this->db->table('ticket_sr_approval_route')->insert(['ticket_id' => $ticket_id, 'emp_id' => $creator_parent_emp_id]);
    }
    //SR Approved
    elseif ($ticket_status_id == 6) {
        $session_emp_id = session('emp_id');

        //if boss of ticket creator
        if($session_emp_id == $creator_parent_emp_id) {
            $add_status_history['custom_msg'] = 'SR Approval request is sent to the Manager/Boss of the Service Engineer.';
            //add new status history
            array_push($status_history, $add_status_history);
            $update_array = ['status_history' => json_encode($status_history)];
            $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

            //update & insert SR approval route
            $this->db->table('ticket_sr_approval_route')->update(['approval' => 1,'active' => 0], ['ticket_id' => $ticket_id, 'emp_id' => $creator_parent_emp_id]);
            $this->db->table('ticket_sr_approval_route')->insert(['ticket_id' => $ticket_id, 'emp_id' => $acceptor_parent_emp_id]);
        }
        //if boss of service engineer (ticket acceptor)
        elseif($session_emp_id == $acceptor_parent_emp_id) {
            //add new status history
            array_push($status_history, $add_status_history);
            $update_array = ['status_history' => json_encode($status_history)];
            $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

            //update ticket status
            $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

            //update SR approval route
            $this->db->table('ticket_sr_approval_route')->update(['approval' => 1,'active' => 0], ['ticket_id' => $ticket_id, 'emp_id' => $acceptor_parent_emp_id]);

            //update device return request to warehouse
            $this->db->table('hardware_serial')->update(['returned' => 1,'replacement_ticket_id' => $ticket_id], ['hw_sl_id' => $hw_sl_id]);
        }
        //if 2nd boss of service engineer (ticket acceptor)
        elseif($session_emp_id == $acceptor_2nd_parent_emp_id) {
            //add new status history
            array_push($status_history, $add_status_history);
            $update_array = ['status_history' => json_encode($status_history)];
            $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

            //update ticket status
            $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

            //update SR approval route
            $this->db->table('ticket_sr_approval_route')->update(['approval' => 1,'active' => 0], ['ticket_id' => $ticket_id, 'emp_id' => $acceptor_2nd_parent_emp_id]);

            //update device return request to warehouse
            $this->db->table('hardware_serial')->update(['returned' => 1,'replacement_ticket_id' => $ticket_id], ['hw_sl_id' => $hw_sl_id]);
        }
    }
    //SR Awaiting Senior Approval
    elseif ($ticket_status_id == 3) {
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = ['status_history' => json_encode($status_history)];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

        //update & insert SR approval route
        $this->db->table('ticket_sr_approval_route')->update(['approval' => 2,'active' => 0], ['ticket_id' => $ticket_id, 'emp_id' => $acceptor_parent_emp_id]);
        $this->db->table('ticket_sr_approval_route')->insert(['ticket_id' => $ticket_id, 'emp_id' => $acceptor_2nd_parent_emp_id]);
    }
    //SR Denied
    elseif ($ticket_status_id == 7) {
        $add_status_history['custom_msg'] = '<b>Device Serial No:</b> '.$hw_text;
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = ['status_history' => json_encode($status_history)];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);

        //update device serial & reason for SR
        $this->db->table('ticket_details')->update(['hw_sl_id' => null,'sr_reason_msg' => null], ['ticket_id' => $ticket_id]);

        //update SR approval route
        $this->db->table('ticket_sr_approval_route')->update(['approval' => 0,'active' => 0], ['ticket_id' => $ticket_id, 'emp_id' => session('emp_id')]);
    }
    //Closed, Re-Opened
    else {
        //add new status history
        array_push($status_history, $add_status_history);
        $update_array = ['status_history' => json_encode($status_history)];
        $this->db->table('ticket_comments')->update($update_array, ['ticket_id' => $ticket_id]);

        //update ticket status
        $this->db->table('ticket_details')->update(['ticket_status' => $ticket_status_id], ['ticket_id' => $ticket_id]);
    }

    $message = 'Ticket Status Updated';
    $return_data['status'] = $status;
    $return_data['message'] = $message;
    $return_data['accepted_at'] = $accepted_at;
    $return_data['deadline'] = $deadline;
    $return_data['last_updated'] = date('d-M-Y h:i A');
    return $return_data;
  }


  public function getAllTickets($emp_id) {
    //get all ticket_ids referred to this user
    $sr_route_rs = $this->db->table('ticket_sr_approval_route')->where(['emp_id'=>$emp_id,'active'=>1])->get()->getResultArray();
    $ticket_ids = array_column($sr_route_rs, 'ticket_id');

    $builder = $this->db->table('ticket_details')
        ->select('ticket_details.ticket_id, ticket_details.ticket_number, ticket_details.topic_id, ticket_details.ticket_subject, ticket_details.ticket_category, ticket_details.ticket_severity, ticket_details.ticket_category, ticket_details.created_on, ticket_details.created_by, ticket_details.ticket_status, ticket_status_master.ticket_status_id, ticket_status_master.ticket_status_name, master_severity.id, master_severity.ticket_severity_name, master_ticket_category.ticket_category_name, master_employee.emp_name, master_employee.email_id, ticket_comments.accepted_by_name, ticket_comments.accepted_at, ticket_comments.status_history')
        ->join('master_severity', 'master_severity.id = ticket_details.ticket_severity')
        ->join('master_ticket_category', 'master_ticket_category.id = ticket_details.ticket_category')
        ->join('master_employee', 'master_employee.id = ticket_details.created_by')
        ->join('ticket_comments', 'ticket_comments.ticket_id = ticket_details.ticket_id')
        ->join('ticket_status_master', 'ticket_status_master.ticket_status_id = ticket_details.ticket_status')
        ->where([
            'ticket_details.row_status' => 1, //ticket active
            'ticket_details.created_by !=' => $emp_id, //skip own created tickets
        ])
        ->groupStart();
      $builder->where('ticket_details.ticket_status', 1); //ticket status open
      if (session('emp_gr_id')) { //if this user belongs to any group
          $builder->orWhere('ticket_details.emp_gr_id', session('emp_gr_id')); //user belongs to a group, to where the ticket is delegated
      }
      $builder->orWhere('ticket_comments.accepted_by', $emp_id); //accepted tickets
      if (count($ticket_ids) > 0) {
          $builder->orWhereIn('ticket_details.ticket_id', $ticket_ids); //awaiting SR approval from this user (table: ticket_sr_approval_route)
      }
      $builder->orWhere(' JSON_CONTAINS(JSON_EXTRACT(ticket_comments.status_history, "$[*].updated_by"), \'"'.$emp_id.'"\', "$") '); //ticket status updated by this user
      $tickets_rs = $builder->groupEnd()
          ->orderBy('ticket_details.ticket_id', 'DESC')
          ->limit(100)
          ->get()->getResult();
        //  echo $this->db->getLastQuery();die();

      return $tickets_rs;
  }









    // ---------------------------------------

    public function office($ins_data){
      $this->db->table('ticket_details')->insert($ins_data);
      return true;
    }

    

    public function removeTableDataEM($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function

    public function getTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('ticket_details')->select('*')->where(['row_status' => 1, 'ticket_id' => $table_id])->get()->getResult();

      $return_data['status'] = $status;
      $return_data['row'] = $row;
      return $return_data;
    }//end function
    

    public function getDeviceSerialonHIS($hw_id){
      $status = true;
      $return_data = array();

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function


    public function getDesigTableDataEM(){
      $request = \Config\Services::request();
      $ho_id = $request->getPost('ho_id');      
      $wh_id = $request->getPost('wh_id');     
      $ol_id = $request->getPost('ol_id');

      $data = array();
      $particulars = array();
      $invoice_details = array();
      $inv_paymentHistory = array();

      $result = $this->db->table('ticket_details')->select('*')->where(['ho_id' => $ho_id, 'wh_id' => $wh_id, 'ol_id' => $ol_id, 'row_status' => 1 ])->get()->getResult();

      //echo json_encode($result);

      $counter = 1;
      if(count($result) > 0){
        for($i = 0; $i < sizeof($result); $i++){
          $nestedData['slNo'] = $counter;
          $nestedData['ticket_id'] = $result[$i]->ticket_id;
          $nestedData['primary_phone'] = $result[$i]->primary_phone;
          $nestedData['secondary_phone'] = $result[$i]->secondary_phone;
          $nestedData['email_id'] = $result[$i]->email_id;
          $nestedData['action'] = '<td class="d-flex justify-content-evenly"><a href="javascript: void(0);" class="edit_class" data-table_id="'.$result[$i]->ticket_id.'"><i class="fa fa-edit"></i></a> <a class="remove" href="javascript: void(0);"><i class="fas fa-times" data-table_id="'.$result[$i]->ticket_id.'"></i></a></td>';

          $counter++;
          array_push($data, $nestedData);
        }
      }
      $json_data = array(
          "recordsTotal"    => sizeof($data),
          "recordsFiltered" => sizeof($data),
          "data"            => $data
      );       
      
      return $json_data;
    }//end function    

    public function checkTicketStatus($ticketNo){
      $status = true;
      $message = 'Invallid ticket number';
      $return_data = array();

      //$this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

      $return_data['status'] = $status;
      $return_data['message'] = $message;
      return $return_data;
    }//end function   

    public function getHwSerialNo($hw_id){
      $status = true;
      $return_data = array();      

      $row = $this->db->table('hardware_serial')->select('*')->where(['row_status' => 1, 'hw_id' => $hw_id ])->get()->getResult();

      $option_text = '<option value="0">Select</option>';
      for($i = 0; $i < sizeof($row); $i++){
        $option_text .= '<option value="'.$row[$i]->hw_sl_id.'">'.$row[$i]->serial_no.'</option>';
      }//end for

      $return_data['status'] = $status;
      $return_data['option_text'] = $option_text;

      return $return_data;
    }//end function  

    public function removeTableDataHIS($table_id){
      $status = true;
      $return_data = array();

      $this->db->table('ticket_details')->where('ticket_id', $table_id)->delete();

      $return_data['status'] = $status;
      return $return_data;
    }//end function
    

   

    

    

  

    public function getSeverityMaster(){
      $severty_rows = $this->db->table('master_severity')->select('*')->where(['row_status' => 1])->get()->getResult();
      return $severty_rows;
    }//end function


}