<?php

namespace mvc\controller\traits;

use mvc\middleware\Validator;
use mvc\core\Message;
use mvc\model\Request;
use mvc\model\File;
use mvc\core\auth\Auth;

/**
 * This trait is for deleting files.
 * 
 */
trait Delete
{
    /**
     * This method deletes a file.
     * 
     * @param request user request
     */
    public function doDelete($request) 
    {
        $data = $request->getBody();

        $valid = Validator::validate($data);

        if (!Auth::checkUser())
        {
            Message::addMessage("You don't have access.");
            return $this->redirect("home", 303);
        }

        if ($valid) {
            $id = $data['id'];
            $address = (new File())->selectFileById($id)->link;
            if ( (new File())->removeFile($id) ) {
                unlink($address);
                Message::addMessage("File removed.", Message::OK);
            } else {
                Message::addMessage("Something went wrong.", Message::WARN);
            }
            return $this->redirect("home");
        } else {
            return $this->redirect("home", 303);
        }
    }
}

?>