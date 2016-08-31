<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/17/15
 * Time: 10:21 PM
 */

class Api_model extends CI_Model{


    /**
     *
    Create select single,
     * select multiple

    Create add 

    Create update

    Create Delete

    Create select random

    Create select order by single

    Create select order by multiple

    Create select limit 

    Create select limit order by

     */

    public function get_single_generic($table)

    {
        $resp = $this->db->get($table)->result_array();
        if(sizeof($resp) > 0)
            $resp = $resp[0];
        return $resp;

    }

    public function get_multiple_generic($table)

    {
        $resp = $this->db->get($table)->result_array();

        return $resp;

    }

    public function get_single_condition_generic($table,$condition)

    {
        $this->db->where($condition);
        $resp = $this->db->get($table)->result_array();
        if(sizeof($resp) > 0)
            $resp = $resp[0];
        return $resp;

    }

    public function get_multiple_condition_generic($table,$condition)

    {
        $this->db->where($condition);
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }

    public function get_generic_single_random($table)

    {
        $this->db->oder_by('id','RANDOM');
        $this->db->limit(1);
        $resp = $this->db->get($table)->result_array();
        if(sizeof($resp) > 0)
            $resp = $resp[0];
        return $resp;

    }

    public function get_generic_multiple_random($table)

    {
        $this->db->oder_by('id','RANDOM');
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }

    public function get_generic_single_random_condition($table,$data)

    {
        $this->db->where($data);
        $this->db->oder_by('id','RANDOM');
        $this->db->limit(1);
        $resp = $this->db->get($table)->result_array();
        if(sizeof($resp) > 0)
            $resp = $resp[0];
        return $resp;

    }

    public function get_generic_multiple_random_condition($table,$data)

    {
        $this->db->where($data);
        $this->db->oder_by('id','RANDOM');
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }


    public function get_generic_multiple_order_condition($table,$data)

    {
        $this->db->oder_by($data);
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }
   public function get_generic_multiple_limit($table,$data)

    {
        $this->db->limit($data);
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }
   public function get_generic_multiple_limit_condition($table,$limit,$data)

    {
        $this->db->where($data);
        $this->db->limit($limit);
        $resp = $this->db->get($table)->result_array();
        return $resp;

    }

    public function get_generic_multiple_limit_order($table,$limit,$temp)
    {
        $this->db->order_by($temp[0],$temp[1]);
        $this->db->limit($limit);
        return $this->db->get($table)->result_array();
    }


    public function get_generic_multiple_limit_order_condition($table,$limit,$temp,$data)
    {
        $this->db->where($data);
        $this->db->order_by($temp);
        $this->db->limit($limit);
        return $this->db->get($table)->result_array();
    }


    public function get_generic($query)
    {
        return $this->db->query($query)->result_array();
    }

    public function add($table,$data)
    {

        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    public function update($table,$data,$condition=array())
    {
        if(sizeof($condition) != 0)
            $this->db->where($condition);
        $this->db->update($table,$data);
        return true;

    }

    public function remove($table,$condition)
    {
        $this->db->where($condition);
        $this->db->delete($table);
        return true;

    }

    public function remove_this($table,$condition)
    {
        $this->db->where(array('id'=>$condition));
        $this->db->delete($table);
        return true;

    }





}