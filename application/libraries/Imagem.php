<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagem{

    public function GerarImagem($imagem, $largura, $altura){

        $CI =& get_instance();

        $config = array();

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/'.$imagem;
        $config['new_image'] = 'uploads/'.$altura.'x'.$largura.'_'.$imagem;
        $config['maintain_ratio'] = true;
        $config['width'] = $largura;
        $config['quality'] = "100%";
        $config['height'] = $altura;

        $CI->load->library('image_lib');

        $CI->image_lib->initialize($config);

        if(!$CI->image_lib->resize()){
            return $CI->image_lib->display_errors();
        }

        $CI->image_lib->clear();

        return $altura.'x'.$largura.'_'.$imagem;

    }

}
?>