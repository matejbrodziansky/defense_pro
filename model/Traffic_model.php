<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Traffic_model extends CI_Model
{

    //GET
    public function getParagraphs()
    {
        return $this->db->select('*')
            ->from('legal_paragraphs')
            ->get()
            ->result_array();
    }



    public function getTrafficDisruption($id)
    {
        return $this->db->select('*')
            ->from('traffic_disruptions')
            ->where('id', $id)
            ->get()
            ->row_array();
    }

    public function getTrafficDisruptionsParagraphsIds($id)
    {
        return $this->db->select('legal_paragraph_id')
            ->from('traffic_discruption_legal_paragraphs')
            ->where('traffic_discruption_id', $id)
            ->get()
            ->result_array();
    }



    public function getLegalParagraphs($id)
    {
        $data =   $this->db->select('*')
            ->from('legal_paragraphs')
            ->where('id', $id)
            ->get()
            ->row_array();


        return $data;
    }

    //INSERT

    public function insertTrafficDisruption($disruption_data)
    {
        $this->db->insert('traffic_disruptions', $disruption_data);
        return $this->db->insert_id();
    }

    public function inserTraffiscDrisruptionsParagraphs($insert_paragraphs)
    {
        return $this->db->insert_batch('traffic_discruption_legal_paragraphs', $insert_paragraphs);
    }
    public function insertTrafficDristributionImage($id, $disruption_image_data)
    {

        if (!empty($disruption_image_data)) {
            $this->db
                ->where('id', $id)
                ->update('traffic_disruptions', $disruption_image_data);
        }

        return $this->db->insert_id();
    }



    // UPDATE
    public function updateTrafficDisruption($id, $disruption_data)
    {
        $this->db->where('id', $id)
            ->update('traffic_disruptions', $disruption_data);
        return $id;
    }

    public function updateTrafficDiscruptionImage($id, $key, $name)
    {
        $this->db->set($key, NULL)
            ->where('id', $id)
            ->update('traffic_disruptions');
    }



    public function getTrafficDisruptions()
    {
        return $this->db->select('*')
            ->from('traffic_disruptions')
            ->get()
            ->result_array();
    }

    // DELETE
    public function deleteParagraphs($id)
    {
        $this->db->where('traffic_discruption_id', $id)
            ->delete('traffic_discruption_legal_paragraphs');
    }
    public function deleteDisruption($id)
    {
        $this->db->where('id', $id)
            ->delete('traffic_disruptions');
    }



    //skuska

    function saveThumbnail($saveToDir, $imagePath, $imageName, $max_x, $max_y)
    {
        preg_match("'^(.*)\.(gif|jpe?g|png)$'i", $imageName, $ext);
        switch (strtolower($ext[2])) {
            case 'jpg':
            case 'jpeg':
                $im   = imagecreatefromjpeg($imagePath);
                break;
            case 'gif':
                $im   = imagecreatefromgif($imagePath);
                break;
            case 'png':
                $im   = imagecreatefrompng($imagePath);
                break;
            default:
                $stop = true;
                break;
        }

        if (!isset($stop)) {
            $x = imagesx($im);
            $y = imagesy($im);

            if (($max_x / $max_y) < ($x / $y)) {
                $save = imagecreatetruecolor($x / ($x / $max_x), $y / ($x / $max_x));
            } else {
                $save = imagecreatetruecolor($x / ($y / $max_y), $y / ($y / $max_y));
            }
            imagecopyresized($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);

            imagegif($save, "{$saveToDir}{$ext[1]}.gif");
            imagedestroy($im);
            imagedestroy($save);

            return TRUE;
        }
    }


    function resizeImages($tmpname, $size, $save_dir, $save_name, $maxisheight = 0)
    {


        // pre_r($size);
        
        $save_dir     .= (substr($save_dir, -1) != "/") ? "/" : "";
        $gis        = getimagesize($tmpname);
        $type        = $gis[2];
        switch ($type) {
            case "1":
                $imorig = imagecreatefromgif($tmpname);
                break;
            case "2":
                $imorig = imagecreatefromjpeg($tmpname);
                break;
            case "3":
                $imorig = imagecreatefrompng($tmpname);
                break;
            default:
                $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imagesx($imorig);
        $y = imagesy($imorig);

        $woh = (!$maxisheight) ? $gis[0] : $gis[1];

        if ($woh <= $size) {
            $aw = $x;
            $ah = $y;
        } else {
            if (!$maxisheight) {
                $aw = $size;
                $ah = $size * $y / $x;
            } else {
                $aw = $size * $x / $y;
                $ah = $size;
            }
        }
        $im = imagecreatetruecolor($aw, $ah);
        if (imagecopyresampled($im, $imorig, 0, 0, 0, 0, $aw, $ah, $x, $y))
            if (imagejpeg($im, $save_dir . $save_name))
                return true;
            else
                return false;
    }
}
