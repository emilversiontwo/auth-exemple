<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Cotalog;
use App\Services\Cotalog\Dto\GetDto;
use App\Services\Cotalog\Dto\StoreDto;
use App\Services\Cotalog\Dto\UpdateDto;
use App\Services\Cotalog\Http\GetHttpService;
use App\Services\Cotalog\Http\StoreHttpService;
use App\Services\Cotalog\Http\UpdateHttpService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class AdminController extends Controller
{
    /** @var StoreHttpService */
    private StoreHttpService $storeHttpService;

    /** @var GetHttpService */
    private GetHttpService $getHttpService;

    /** @var UpdateHttpService */
    private UpdateHttpService $updateHttpService;

    /**
     * @param StoreHttpService $storeHttpService
     * @param GetHttpService $getHttpService
     * @param UpdateHttpService $updateHttpService
     */
    public function __construct(
        StoreHttpService $storeHttpService,
        GetHttpService   $getHttpService,
        UpdateHttpService $updateHttpService,
    )
    {
        $this->storeHttpService = $storeHttpService;
        $this->getHttpService = $getHttpService;
        $this->updateHttpService = $updateHttpService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $items = Cotalog::all();

        return view('admin.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateShopRequest $request
     * @return RedirectResponse
     */
    public function store(CreateShopRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->storeHttpService->store(new StoreDto($data));

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     * @param int $admin
     * @return Factory|View|Application
     */
    public function show(int $admin): Factory|View|Application
    {
        $model = $this->getHttpService->get(new GetDto(['cotalogId' => $admin]));

        return view('admin.show', ['item' => $model->toArray()]);

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $admin
     * @return Factory|View|Application
     */
    public function edit(int $admin): Factory|View|Application
    {
        $model = $this->getHttpService->get(new GetDto(['cotalogId' => $admin]));

        return view('admin.edit', ['item' => $model->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateShopRequest $request
     * @param int $admin
     * @return RedirectResponse
     */
    public function update(UpdateShopRequest $request, int $admin): RedirectResponse
    {
        $data = $request->validated();
        $data['cotalogId'] = $admin;

        $dto = new UpdateDto($data);
        $this->updateHttpService->update($dto);

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $admin
     * @return RedirectResponse
     */
    public function destroy(int $admin): RedirectResponse
    {
        $model = $this->getHttpService->get(new GetDto(['cotalogId' => $admin]));

        $model->delete();

        return redirect()->route('admin.index');
    }
}
