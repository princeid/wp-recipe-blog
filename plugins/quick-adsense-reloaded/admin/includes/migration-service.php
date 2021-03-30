<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class QUADS_Ad_Migration {
    private static $instance;

    public static function getInstance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	/**
	 * @param $ad_id
	 * @param $post_meta
	 *
	 * @return mixed
	 */
	public function quadsUpdateOldAd($ad_id, $post_meta){

            $new_data = array();

            $new_data = $post_meta;

            $old_ad_id      = get_post_meta($ad_id, 'quads_ad_old_id', true);

            $quads_settings = get_option( 'quads_settings' );

            if($old_ad_id){
                $quads_settings['ads'][$old_ad_id] = $new_data;
            }else{

            $old_ads = array();
            $ad_count = 1;

            foreach($quads_settings['ads'] as $key => $ads){
                if($key == 'ad'.$ad_count){
                    $ad_count++;
                    $old_ads[$key] = $ads;
                }
            }
            $old_ads['ad'.$ad_count] = $new_data;
            $quads_settings['ads'] = $old_ads;
            update_post_meta($ad_id, 'quads_ad_old_id', 'ad'.$ad_count);

            }
            update_option('quads_settings', $quads_settings);

            return $ad_id;
     }
    public function quadsAdReset(){
        global $quads_options;
        $quadsAdReset = get_option( 'quadsAdReset' );
	    $quads_mode = get_option('quads-mode');
        if(!$quadsAdReset && $quads_mode == 'new'){
            require_once QUADS_PLUGIN_DIR . '/admin/includes/rest-api-service.php';
            $api_service = new QUADS_Ad_Setup_Api_Service();
            $quads_ads = $api_service->getAdDataByParam('quads-ads');
            $duplicate_array =array();

            if(isset($quads_ads['posts_data'])) {
                foreach ($quads_options['ads'] as $key1 => $value1) {
                    foreach ($quads_ads['posts_data'] as $key => $value) {
                        $ads = $value['post_meta'];
                        if($key1 == $ads['quads_ad_old_id'] && $value1['ad_id'] != $ads['ad_id']){
                            if(isset($ads['random_ads_list']))
                                $ads['random_ads_list'] = unserialize($ads['random_ads_list']);
                            if(isset($ads['visibility_include']))
                                $ads['visibility_include'] = unserialize($ads['visibility_include']);
                            if(isset($ads['visibility_exclude']))
                                $ads['visibility_exclude'] = unserialize($ads['visibility_exclude']);

                            if(isset($ads['targeting_include']))
                                $ads['targeting_include'] = unserialize($ads['targeting_include']);

                            if(isset($ads['targeting_exclude']))
                                $ads['targeting_exclude'] = unserialize($ads['targeting_exclude']);

                            $duplicate_array[] =$ads;
                        }
                    }
                }
            }
            if(!empty($duplicate_array)){
                $ad_count = 1;
                if(isset($quads_options['ads']) && !empty($quads_options['ads'])){
                    end($quads_options['ads']);
                    $key = key($quads_options['ads']);
                    if(!empty($key)){
                        $key_array =   explode("ad",$key);
                        if(is_array($key_array)){
                            $ad_count = (isset($key_array[1]) && !empty($key_array[1]))?$key_array[1]+1:1;
                        }
                    }
                }

                foreach ($duplicate_array as $duplicate){
                    $old_ads = $quads_options['ads'];
                    $duplicate['quads_ad_old_id'] = 'ad'.$ad_count;
                    $old_ads['ad'.$ad_count] = $duplicate;
                    update_post_meta($duplicate['ad_id'], 'quads_ad_old_id', 'ad'.$ad_count);
                    $quads_options['ads'] = $old_ads;
                    $ad_count++;
                }
                update_option('quads_settings_backup_reset', $quads_options);
                update_option('quads_settings', $quads_options);
            }
          update_option('quadsAdReset', true);
        }

    }


	public function quadsAdResetDeleted(){
		global $quads_options;
		$quadsAdResetDeleted = get_option( 'quadsAdResetDeleted' );
		$quads_mode = get_option('quads-mode');
		if(!$quadsAdResetDeleted && $quads_mode == 'new'){
			$quads_settings = get_option('quads_settings');
			update_option('quadsAdResetDeleted', $quads_settings);
			require_once QUADS_PLUGIN_DIR . '/admin/includes/rest-api-service.php';
			$api_service = new QUADS_Ad_Setup_Api_Service();
			$quads_ads = $api_service->getAdDataByParam('quads-ads');
			$check_array =array();
			if(isset($quads_ads['posts_data'])) {
				foreach ($quads_ads['posts_data'] as $key => $value) {
					$ads = $value['post_meta'];
					if ( ! in_array( $ads['quads_ad_old_id'], $check_array ) ) {
						$check_array[] = $ads['quads_ad_old_id'];
					}
				}
			}
			foreach ( $quads_settings['ads'] as $key => $value ) {
				if( ! in_array( $key, $check_array )){
					unset($quads_settings['ads'][$key]);
				}
			}
			$quads_options =$quads_settings;
			update_option('quads_settings', $quads_settings);
		}
	}
}

if(class_exists('QUADS_Ad_Migration')){
    $quadsAdMigration = QUADS_Ad_Migration::getInstance();
    $quadsAdMigration->quadsAdReset();
	$quadsAdMigration->quadsAdResetDeleted();
}
