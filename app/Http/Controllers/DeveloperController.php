<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DeveloperResource;
use App\Repository\DeveloperRepositoryInterface;

class DeveloperController extends Controller
{
    private $developerRepository;

    public function __construct(DeveloperRepositoryInterface $developerRepository)
    {
        $this->developerRepository = $developerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (count($request->query) > 0) {
            if ($request->query('nome')) {
                $developers = $this->developerRepository->listByQuery('nome', $request->query('nome'));
            }

            if ($request->query('sexo')) {
                $developers = $this->developerRepository->listByQuery('sexo', $request->query('sexo'));
            }

            if ($request->query('idade')) {
                $developers = $this->developerRepository->listByQuery('idade', $request->query('idade'));
            }

            if ($request->query('hobby')) {
                $developers = $this->developerRepository->listByQuery('hobby', $request->query('hobby'));
            }

            if ($request->query('datanascimento')) {
                $developers = $this->developerRepository->listByQuery('datanascimento', $request->get('datanascimento'));
            }

            try {
                return DeveloperResource::collection($developers)
                    ->response()
                    ->setStatusCode(200);
            } catch (\Throwable $th) {
                return response('', 404);
            }
        }

        try {
            $developers = $this->developerRepository->listAll();

            return DeveloperResource::collection($developers)
                ->response()
                ->setStatusCode(200);
        } catch (\Throwable $th) {
            return response('', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $developer = $this->developerRepository->create($request->all());

            return (new DeveloperResource($developer))
                ->response()
                ->setStatusCode(201);
        } catch (\Throwable $th) {
            return response('', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $developer = $this->developerRepository->show($id);

            return (new DeveloperResource($developer))
                ->response()
                ->setStatusCode(200);
        } catch (\Throwable $th) {
            return response('', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $developer = $this->developerRepository->update($id, $request->all());

            return (new DeveloperResource($developer))
                ->response()
                ->setStatusCode(200);
        } catch (\Throwable $th) {
            return response('', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $this->developerRepository->delete($id);

            return response('', 204);
        } catch (\Throwable $th) {
            return response('', 400);
        }
    }
}
