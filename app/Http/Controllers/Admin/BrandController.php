<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;


class BrandController extends BaseController
{
    /**
     * @var BrandContract
     */
    protected $brandRepository;

    /**
     * Brand Controller constructor.
     * @param BrandContract $brandRepository
     */
    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $brands = $this->brandRepository->listBrands();

        $this->setPageTitle('Brands', 'Lise of all brands');
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $this->setPageTitle('Brands', 'Create Brand');
        return view('admin.brands.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:191',
            'logo'  => 'mimes:png,jpg,jpeg|max:1000'
        ]);

        $params = $request->except('_token');

        $brand = $this->brandRepository->createBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Error occured while creating brand.', 'error', true, true);
        }

        return $this->responseRedirect('admin.brands.index', 'Brand added successfully', 'success', false, false);
    }

    public function edit($id)
    {
        $brand = $this->brandRepository->findBrandById($id);

        $this->setPageTitle('Brands', 'Edit Brand : '.$brand->name);
        return view('admin.brands.edit', compact('brand'));

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:191',
            'logo'  => 'mimes:png,jpg,jpeg|max:1000'
        ]);

        $params = $request->except('_token');
        $brand = $this->brandRepository->updateBrand($params);

        if (!$brand) {
            return $this->responseRedirectBack('Error occured while updating brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand updated successfully', 'success', false, false);
    }

    public function delete($id)
    {
        $brand = $this->brandRepository->deleteBrand($id);

        if (!$brand) {
            return $this->responseRedirectBack('Error occured while deleting brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand deleted successfully', 'success', false, false);
    }

}
