<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttachmentController extends Controller
{

    public function create($new_attachment)
    {
        $attachment = Attachment::create(
            [
                'answer_id'         => $new_attachment->answer_id,
                'url'               => $new_attachment->url,
                'size'              => $new_attachment->size,
                'type'              => $new_attachment->type,
            ]
        );
        return $attachment;
    }

    public function delete($id)
    {
        $attachment = Attachment::find($id);
        $attachment->delete();

        return response('deleted', Response::HTTP_OK);
    }

    public function updateOrCreate($new_attachment)
    {

        $arrayToCreate = [
            'answer_id'     => $new_attachment['answer_id'],
            'url'           => $new_attachment['url'],
            'size'          => $new_attachment['size'],
            'type'          => $new_attachment['type'],
        ];



        $result = Attachment::firstOrCreate(
            [
                'answer_id' => $new_attachment['answer_id'],
            ],
            $arrayToCreate
        );


        if ($result->wasRecentlyCreated) {
            // Do nothing
        } else {
            Attachment::where('id', $result->id)
                ->update($arrayToCreate);
        }

        return $result->id;

    }
}
