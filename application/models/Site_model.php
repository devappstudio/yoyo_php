<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/26/15
 * Time: 12:45 PM
 */

class Site_model extends CI_Model
{
    public $Users_Table;
    public $Coupons_Table;
    public $Institutions_Table;
    public $Items_Table;
    public $curl;

    function __construct()
    {
        parent::__construct();
        $this->Users_Table = 'users';
        $this->Coupons_Table = 'coupons';
        $this->Institutions_Table = 'institutions';
        $this->Items_Table = 'items';
        $this->curl = curl_init();

    }

    function post_data($url,$data)
    {

        curl_setopt_array($this->curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
        ));
        $resp = curl_exec($this->curl);
       // curl_close($this->curl);
        return $resp;
    }

    function put_data($url,$data)
    {

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $resp = curl_exec($this->curl);
        curl_close($this->curl);
        return $resp;
    }

    function add_user($data)
    {
        $data['table'] = $this->Users_Table;
        return $this->post_data(base_url().'index.php/api_v1/generic_add',$data);
    }


    public function prepare_dashboard()
    {
        //total number of coupons

        //total number of coupons redeemed
        //sum total of pending coupons
        //
    }

    public function prepare_price_lists()
    {
      //  return $this
    }

    public function add_price($data)
    {
        $data['table'] = $this->Items_Table;
        return $this->post_data(base_url().'index.php/api_v1/generic_add',$data);
    }
   public function new_coupon($data)
    {
        $data['table'] = $this->Coupons_Table;
        return $this->post_data(base_url().'index.php/api_v1/generic_add',$data);
    }

     public function update_price($condition,$temp)
    {
        $data = array();
        $data['table'] = $this->Items_Table;
        $data['data'] = $temp;
        $data['condition'] = $condition;
        return $this->put_data(base_url().'index.php/api_v1/generic_update',$data);
    }

    public function redeem($data)
    {
        return $this->put_data(base_url().'index.php/api_v1/generic_update',$data);
    }

    public function coupons_data()
    {
        $final = array();
        $data =  $this->session->coupons;
        $this->session->unset_userdata('coupons');
        foreach($data as $id)
        {
            $coupon = json_decode(
                file_get_contents(base_url().'index.php/api_v1/generic_single_condition/table/coupons/id/'.$id)
            );

            $item = json_decode(
                file_get_contents(base_url().'index.php/api_v1/generic_single_condition/table/items/id/'.$coupon->id_item)
            );
            $coupon_color = json_decode(
                file_get_contents(base_url().'index.php/api_v1/generic_single_condition/table/coupon_colors/id/'.$item->id_color)
            );

            $final[sizeof($final)] = array(
                'ref_number'=>$coupon->ref_number,
                'price_tag'=>$item->name,
                'color'=>$coupon_color->color,
                'cost'=>$coupon->cost,
            );
        }

        return $final;
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Vincenty formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */

    public static function vincentyGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }





}