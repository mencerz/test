<?php

namespace App\Http\Controllers;

use App\ClientRequest;
use App\Jobs\MailSender;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clientRequests = ClientRequest::with('user')->get();

        return view('manager.index', compact([
            'clientRequests'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('client.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(ClientRequest::createRules());

        $user = Auth::user();
        $data = $request->only('subject', 'message');

        $filePath = $request->file('file')->store(ClientRequest::FILES_STORE_DIR);
        $clientRequest = ClientRequest::add($data, $filePath, $user);

        // i know another way
        MailSender::dispatch($clientRequest);

        return Redirect()->to('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        // simple toggle, in the right way, it would be nice to check the past value
        // there could be an entity in the argument, but to simplify this ..
        $clientRequest = ClientRequest::find($id);

        if (!$clientRequest) {
            return Response()->json('not found', 404);
        }

        $clientRequest->toggleViewed();

        return Response()->json('success');
    }

    /**
     * @param $id
     * @return Response|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile($id)
    {
        $clientRequest = ClientRequest::find($id);

        if (!$clientRequest) {
            return response('not found', 404);
        }
        if (!Storage::exists($clientRequest->file_link)) {
            return response('file is broken', 404);
        }
        return Storage::download($clientRequest->file_link);
    }
}
