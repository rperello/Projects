<?php
namespace TypiCMS\Modules\Projects\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use JavaScript;
use Response;
use Session;
use TypiCMS\Http\Controllers\AdminSimpleController;
use TypiCMS\Modules\Projects\Http\Requests\FormRequest;
use TypiCMS\Modules\Projects\Repositories\ProjectInterface;
use TypiCMS\Modules\Tags\Models\Tag;
use View;

class AdminController extends AdminSimpleController
{

    public function __construct(ProjectInterface $project)
    {
        parent::__construct($project);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        JavaScript::put([
            'tags' => Tag::lists('tag')
        ]);

        $model = $this->repository->getModel();
        return view('core::admin.create')
            ->with(compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model    $model
     * @return Response
     */
    public function edit($model)
    {
        JavaScript::put([
            'tags' => Tag::lists('tag')
        ]);

        return view('core::admin.edit')
            ->with(compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->all());
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($model, FormRequest $request)
    {
        $this->repository->update($request->all());
        return $this->redirect($request, $model);
    }
}