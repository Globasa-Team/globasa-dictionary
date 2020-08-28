<?php
namespace WorldlangDict;

/**
* Function : Download a remote file at a given URL and save it to a local folder.
* Input :
* $url - URL of the remote file
* $loal_file - the directory and file name remove file is to be saved to.
* $toDir - Directory where the remote file has to be saved once downloaded.
* $withName - The name of file to be saved as.
* Output :
* true - if success
* false - if failed
*
* Note : This function does not work in the Codelet due to network restrictions
* but does work when executed from command line or from within a webserver.
*
* Modified from https://www.codercrunch.com/codelet/570508964/download-a-remote-file-at-a-url-and-save-it-locally-in-php
*/
function downloadFile($url, $local_file)
{

    // open file in rb mode
    if ($fp_remote = fopen($url, 'rb')) {

        // local filename
        // $local_file = $toDir ."/" . $withName;

        // read buffer, open in wb mode for writing
        if ($fp_local = fopen($local_file, 'wb')) {

            // read the file, buffer size 8k
            while ($buffer = fread($fp_remote, 8192)) {

                // write buffer in  local file
                fwrite($fp_local, $buffer);
            }

            // close local
            fclose($fp_local);
        } else {
            // could not open the local URL
            fclose($fp_remote);
            return false;
        }

        // close remote
        fclose($fp_remote);

        return true;
    } else {
        // could not open the remote URL
        return false;
    }
} // end
