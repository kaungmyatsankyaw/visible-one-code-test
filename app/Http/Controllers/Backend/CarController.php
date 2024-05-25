<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;  // Make sure to import the Car model

class CarController extends Controller
{
    protected $form_fields;

    public function __construct()
    {
        $this->form_fields =
            [
                [
                    'name' => 'car_no',
                    'type' => 'text',
                    'required' => true,
                    'label' => 'CarNo.'
                ],
                [
                    'name' => 'owner_name',
                    'type' => 'text',
                    'required' => true,
                    'label' => 'Owner Name'
                ],
                [
                    'name' => 'phone',
                    'type' => 'number',
                    'required' => true,
                    'label' => 'Phone'
                ],
                [
                    'name' => 'email',
                    'type' => 'email',
                    'required' => false,
                    'label' => 'Email'
                ],
                [
                    'name' => 'city',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'City'
                ],
                [
                    'name' => 'state',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'State'
                ],
                [
                    'name' => 'country',
                    'type' => 'text',
                    'required' => false,
                    'label' => 'Country'
                ],
                [
                    'name' => 'address',
                    'type' => 'textarea',
                    'required' => false,
                    'label' => 'Address'
                ]
            ];
    }

    public function index()
    {
        // Fetch all cars
        $cars = Car::all();
        return view('backend.car.index', compact('cars'));
    }

    public function create()
    {
        $data['fields'] = $this->form_fields;
        $data['page_title'] = 'Add New Car/Truck';
        return view('backend.car.createOrUpdate', $data);
    }

    public function store(Request $request)
    {

        Car::create($request->all());

        return redirect('/car-truck')->with('status', 'Car created successfully.');
    }

    public function show($id)
    {
        $data['car'] = Car::findOrFail($id);
        $data['page_title'] = 'Edit Car/Truck';
        return view('backend.car.show', $data);
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $data['fields'] = $this->form_fields;
        $data['car'] = $car;
        $data['page_title'] = 'Edit Car/Truck';
        return view('backend.car.createOrUpdate', $data);
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $car->update($request->all());

        return redirect('/car-truck')->with('status', 'Car Update successfully.');

    }

    public function delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect('/car-truck')->with('status', 'Car Delete successfully.');

    }

    private function getValidationRules()
    {
        $rules = [];
        foreach ($this->form_fields as $field) {
            if ($field['required']) {
                $rules[$field['name']] = 'required';
            } else {
                $rules[$field['name']] = 'nullable';
            }
            $rules[$field['name']] .= '|' . $field['type'];
        }
        return $rules;
    }
}
