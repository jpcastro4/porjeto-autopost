<?php
class Instagram_model extends CI_Model{

    public $ig;

    public function __construct(){
        parent::__construct();

        $this->load->helper('url');
    }

    public function autenticate($userSessionID=null){

        set_time_limit(0);

        $this->ig = new \InstagramAPI\Instagram(false, false);
          
        try {

            $this->ig->setUser('agitagoiania','somosfoda');
            $this->ig->login();

            return true;

        } catch (\Exception $e) {

            echo 'Something went wrong: '.$e->getMessage()."\n";
            return false;
            exit(0);
        }

    }


    public function getUser(){

        if( $this->autenticate() ){

            echo '<pre>';
            var_dump( $this->ig );
            echo '</pre>';
        }   
       
    }

    public function location(){

        if( $this->autenticate() ){

            try {  

                $feed = $this->ig->location->searchFacebook('Goiânia');

                foreach ($feed->items as $local ) {
                   
                   echo $local->title.'<br/><br/>';

                   var_dump($local->location );
                }

            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
            }
        }
    }

    public function searchLocation($cidade){

        if( $this->autenticate() ){

            try {  

                echo 'Facebook Location <br/><br/>';
                $localFB = $this->ig->location->searchFacebook($cidade);
                $local = $localFB->items[0];
                echo $local->title .'<br/><br/>';

                var_dump($local->location );

                //echo 'Por Lat e Long <br/><br/>';

                //$localInsta = $this->ig->location->search($local->location->lat,$local->location->lng,$cidade);

                //var_dump($localInsta);

                $url = base_url('index/feedLocation/'.$local->location->pk);
                echo anchor($url, 'title=""', array('target' => '_blank', 'class' => 'new_window'));
               
            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
            }
        }
    }

    public function feedLocation($locationID){

       if( $this->autenticate() ){

            try {  

                $feed = $this->ig->location->getRelated($locationID);
                
                var_dump( $feed->fullResponse );

                // foreach ($feed->fullResponse->items as $item ):

                //     echo '<img width="200" style="float:left" src="'.$item->image_versions2->candidates[1]->url.'"/>';

                // endforeach;
                    
                    //echo '<img width="200" style="float:left" src="'.$feed->items[0]->image_versions2->candidates[1]->url.'"/>';

                // }
               
            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
            }
        }
    }

    public function explorer(){

       if( $this->autenticate() ){

            try {  

                $feed = $this->ig->discover->getExploreFeed();

                var_dump( $feed);
             
            } catch (\Exception $e) {
                echo 'Something went wrong: '.$e->getMessage()."\n";
            }
        }
    }

    public function getFeed(){
        $this->ig = new \InstagramAPI\Response\GeoMediaResponse ;

        try {
            $feed = $this->ig->getFullResponse() ;
            // The getPopularFeed() has an "items" property, which we need.
            $items = $feed->getItems();

            foreach ($items as $item) :
                
                echo '<img width="200" height="200" src="'.$item->getImageVersions2()->getCandidates()[0]->getUrl().'" />';

            endforeach;
            // Individual item objects have an "id" property.
            // $firstItem_mediaId = $items[0]->getId();
            // // To get properties with underscores, such as "device_stamp",
            // // just specify them as camelcase, ie "getDeviceTimestamp" below.
            // $firstItem_device_timestamp = $items[0]->getDeviceTimestamp();
            // // You can chain multiple function calls in a row to get to the data.
            // $firstItem_image_versions = $items[0]->getImageVersions2()->getCandidates()[0]->getUrl();
            // echo 'There are '.count($items)." items.\n";
            // echo "First item has media id: {$firstItem_mediaId}.\n";
            // echo "First item timestamp is: {$firstItem_device_timestamp}.\n";
            // echo "One of the first item image version candidates is: {$firstItem_image_versions}.\n";

           // var_dump($items);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }
    }

    public function getFeedUser($userId){
        

        try {
            $feed = $ig->getFullResponse() ;
            // The getPopularFeed() has an "items" property, which we need.
            $items = $feed->getItems();

            foreach ($items as $item) :
                
                echo '<img width="200" height="200" src="'.$item->getImageVersions2()->getCandidates()[0]->getUrl().'" />';

            endforeach;
            // Individual item objects have an "id" property.
            // $firstItem_mediaId = $items[0]->getId();
            // // To get properties with underscores, such as "device_stamp",
            // // just specify them as camelcase, ie "getDeviceTimestamp" below.
            // $firstItem_device_timestamp = $items[0]->getDeviceTimestamp();
            // // You can chain multiple function calls in a row to get to the data.
            // $firstItem_image_versions = $items[0]->getImageVersions2()->getCandidates()[0]->getUrl();
            // echo 'There are '.count($items)." items.\n";
            // echo "First item has media id: {$firstItem_mediaId}.\n";
            // echo "First item timestamp is: {$firstItem_device_timestamp}.\n";
            // echo "One of the first item image version candidates is: {$firstItem_image_versions}.\n";

           // var_dump($items);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }
    }

    public function getGeoMedia(){

        try {
            $feed = GeoMediaResponse()->getFullResponse();
            // The getPopularFeed() has an "items" property, which we need.
            
           var_dump($feed);

        } catch (\Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
        }
    }


    
    
}