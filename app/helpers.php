<?php

function flash($title = null, $message = null, $level = 'success')
{

    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {

        return $flash;
    }

    return $flash->overlay($title, $message, $level);
}

/**
 * Retrieve JPEG width and height without downloading/reading entire image.
 *
 * @author james.relyea@zifiniti.com http://php.net/manual/en/function.getimagesize.php
 * @param  string $img_loc path of image
 * @return mixed          
 */
function getjpegsize($img_loc) {

    $handle = fopen($img_loc, "rb") or die("Invalid file stream.");

    $new_block = NULL;

    if(!feof($handle)) {

        $new_block = fread($handle, 32);

        $i = 0;

        if($new_block[$i]=="\xFF" && $new_block[$i+1]=="\xD8" && $new_block[$i+2]=="\xFF" && $new_block[$i+3]=="\xE0") {

            $i += 4;

            if($new_block[$i+2]=="\x4A" && $new_block[$i+3]=="\x46" && $new_block[$i+4]=="\x49" && $new_block[$i+5]=="\x46" && $new_block[$i+6]=="\x00") {

                // Read block size and skip ahead to begin cycling through blocks in search of SOF marker

                $block_size = unpack("H*", $new_block[$i] . $new_block[$i+1]);

                $block_size = hexdec($block_size[1]);

                while(!feof($handle)) {

                    $i += $block_size;

                    $new_block .= fread($handle, $block_size);

                    if($new_block[$i]=="\xFF") {

                        // New block detected, check for SOF marker

                        $sof_marker = array("\xC0", "\xC1", "\xC2", "\xC3", "\xC5", "\xC6", "\xC7", "\xC8", "\xC9", "\xCA", "\xCB", "\xCD", "\xCE", "\xCF");

                        if(in_array($new_block[$i+1], $sof_marker)) {

                            // SOF marker detected. Width and height information is contained in bytes 4-7 after this byte.

                            $size_data = $new_block[$i+2] . $new_block[$i+3] . $new_block[$i+4] . $new_block[$i+5] . $new_block[$i+6] . $new_block[$i+7] . $new_block[$i+8];

                            $unpacked = unpack("H*", $size_data);

                            $unpacked = $unpacked[1];

                            $height = hexdec($unpacked[6] . $unpacked[7] . $unpacked[8] . $unpacked[9]);

                            $width = hexdec($unpacked[10] . $unpacked[11] . $unpacked[12] . $unpacked[13]);

                            return ["width" => $width, "height" => $height];

                        } else {

                            // Skip block marker and read block size

                            $i += 2;

                            $block_size = unpack("H*", $new_block[$i] . $new_block[$i+1]);

                            $block_size = hexdec($block_size[1]);

                        }

                    } else {

                        return FALSE;

                    }

                }

            }

        }

    }

    return FALSE;

}

function link_to($button, $path, $type, $btn_class='btn btn-primary', $btn_title='')
{
    $csrf = csrf_field();

    if(is_object($path)) {

        $action = "/" . $path->getTable();

        if(in_array($type, ['PUT', 'PATCH', 'DELETE'])) {

            $action .= '/' . $path->getKey();
        }

    } else {

        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="{$action}">

            <input type="hidden" name="_method" value="{$type}" />
            
            $csrf

            <button title="{$btn_title}" type="submit" class="{$btn_class}">{$button}</button>


        </form>
EOT;
}