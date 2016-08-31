<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 *
 * User: root
 *
 * Date: 5/17/15
 *
 * Time: 10:22 PM
 *
 */
/**********
 * This generic api was created by Isaac Bremang Darko
 *                           email
 */

require 'vendor/autoload.php';

use Location\Coordinate;
use Location\Distance\Vincenty;

require APPPATH.'/libraries/REST_Controller.php';

class Api_v1 extends REST_Controller

{


    function redeem_code_post()
    {
        $data['reg_id'] = $this->post('code');
        $data['reg_pin'] = $this->post('password');
        $this->db->where($data);
        $card = $this->db->get('card_nums')->row();
        if($card)
        {

            $this->response(array('status'=>1,"data"=>$card),200);

            if($card->status == 0)
            {
                //new registration

            }
            else
            {
                //already registered

            }

        }
        else
        {
            $this->response(array('status'=>0,"error"=>'Sorry Check The Scratch Card Details'), 200);

        }

    }




    function register_user_post()
    {
        $data['reg_id'] = $this->post('cardCode');
        $data['reg_pin'] = $this->post('cardPassword');
        $data['status'] =0;
        $this->db->where($data);
        $card = $this->db->get('card_nums')->row();
        if($card)
        {
            //change status
            $this->db->where($data);
            $this->db->update('card_nums',array('status'=>1));

            //Form Account Number

            $current_users = $this->db->get('main_table')->result();

            $number = sizeof($current_users);
            $number++;

            $to_fill=  6 - strlen($number);
            $account = "";
            for($i = 0; $i<$to_fill;$i++)
            {
                $account .= 0;
            }
            $other = "MZB".substr(date("Y",time()),-2);

            $account = $other."/".substr($this->post('country'),0,2)."/".$account.$number;


            //register user
            $data = array();



            $data['username'] =  $this->post('cardCode');
            $data['pin'] =  $this->post('cardPassword');
            $data['firstname'] =  $this->post('firstName');
            $data['lastname'] =  $this->post('lastName');
            $data['email'] =  $this->post('emailAddress');
            $data['date_of_birth'] =  $this->post('dateOfBirth');
            $data['country'] =  $this->post('country');
            $data['location'] =  $this->post('city');
            $data['phone'] =  $this->post('telephone');
            $data['dividend'] =  0;
            $data['approve'] =  0;
            $data['pound'] =  $card->pound;
            $data['account_no'] =  $account;
            $data['price'] =  $card->price;
            $this->db->insert('main_table',$data);

            $this->db->where('id',$this->db->insert_id());
            $this->response(array('status'=>1,"data"=>$this->db->get('main_table')->row()),200);
        }
        else
        {
            $this->response(array('status'=>0,"error"=>'Sorry Contact Support For Help'), 200);

        }

    }



    function add_payment_mode_post()
    {
        // ``(`id`, ``, ``, `account_no`, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, `refered_by`, `star_list`, ``)

        $data['payment_mode']=$this->post('paymentMode');
        $data['payment_number']=$this->post('paymentNumber');
        $this->db->where(array('username'=>$this->post('cardCode'),'pin'=>$this->post('cardPassword')));
        $this->db->update('main_table',$data);
        $this->response(array('status'=>1,"data"=>"Completed"),200);

    }



    function add_referral_post()
    {
        // ``(`id`, ``, ``, `account_no`, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``)

         if($this->post('accountNumber') != "")
        {
            $data['refered_by']=$this->post('accountNumber');
            $data['star_list']=0;
            $this->db->where(array('username'=>$this->post('cardCode'),'pin'=>$this->post('cardPassword')));
            $this->db->update('main_table',$data);

            $referal = $this->db->get_where('main_table',array('account_no'=>$this->post('accountNumber')));
            if($referal)
            {
                $this->db->where('id',$referal->id);
                $this->db->update('main_table',array('star_list'=>$referal->star_list+1));
                $this->response(array('status'=>1,"data"=>"Completed"),200);

            }
            else
            {
                $this->response(array('status'=>0,"data"=>"Sorry Referral Account Number Not Found"),200);
            }
        }
        else
        {
            $data['refered_by']=$this->post('accountNumber');
            $data['star_list']=0;
            $this->db->where(array('username'=>$this->post('cardCode'),'pin'=>$this->post('cardPassword')));
            $this->db->update('main_table',$data);
            $this->response(array('status'=>1,"data"=>"Completed"),200);
        }


    }


    function retrieve_messages_post()
    {

    }

    function retrieve_details_post()
    {

    }
    function roll_over_post()
    {

    }
    function quit_post()
    {

    }
    function update_details_post()

    {

    }












}
