<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use Livewire\Component;
use App\Models\MyParent;
use App\Models\Religion;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage,$deleteMessage,$updateMessage = '';
    public $catchError;
    public $show_table = true; 
    public $update_mode = false; 
    public $photos; 
    public $parent_id;

    public $currentStep = 1,

           // Father_INPUTS
           $email, $password,
           $name_father, $name_father_en,
           $national_id_father, $passport_id_father,
           $phone_father, $job_father, $job_father_en,
           $nationality_father_id, $blood_type_father_id,
           $address_father, $religion_father_id,

            // Mother_INPUTS
            $name_mother, $name_mother_en,
            $national_id_mother, $passport_id_mother,
            $phone_mother, $job_mother, $job_mother_en,
            $nationality_mother_id, $blood_type_mother_id,
            $address_mother, $religion_mother_id;



    public function show_add_form()
    {
        $this->show_table = false;
        $this->currentStep = 1;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email'              => 'required|email',
            'national_id_father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father' => 'min:10|max:10',
            'phone_father'       => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'national_id_mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_mother' => 'min:10|max:10',
            'phone_mother'       => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }        
    

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'bloods' => Blood::all(),
            'religions' => Religion::all(),
            'parents' => MyParent::all(),
        ]);
    }


    public function submitForm()
    {
        try {
          //  $parent_id = DB::table('my_parents')->insertGetId([
              MyParent::create([
                'email'                 => $this->email,
                'password'              => Hash::make($this->password),
                'name_father'           => ['en' => $this->name_father_en, 'ar' => $this->name_father],
                'national_id_father'    => $this->national_id_father,
                'phone_father'          => $this->phone_father,
                'job_father'            => ['en' => $this->job_father_en, 'ar' => $this->job_father],
                'passport_id_father'    => $this->passport_id_father,
                'nationality_father_id' => $this->nationality_father_id,
                'blood_type_father_id'  => $this->blood_type_father_id,
                'religion_father_id'    => $this->religion_father_id,
                'address_father'        => $this->address_father,
    
                // Mother_INPUTS
                'name_mother'           => ['en' => $this->name_mother_en, 'ar' => $this->name_mother],
                'national_id_mother'    => $this->national_id_mother,
                'passport_id_mother'    => $this->passport_id_mother,
                'phone_mother'          => $this->phone_mother,
                'job_mother'            => ['en' => $this->job_mother_en, 'ar' => $this->job_mother],
                'nationality_mother_id' => $this->nationality_mother_id,
                'blood_type_mother_id'  => $this->blood_type_mother_id,
                'religion_mother_id'    => $this->religion_mother_id,
                'address_mother'        => $this->address_mother,
            ]);


            if($this->photos && count($this->photos) > 0) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->national_id_father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }
            $this->photos = null;
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;

        }catch(\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }


    public function firstStepSubmit()
    {
        $this->validate([
            'email'                 => 'required|unique:my_parents,email,'. $this->id,
            'password'              => 'required',
            'name_father'           => 'required',
            'name_father_en'        => 'required',
            'job_father'            => 'required',
            'job_father_en'         => 'required',
            'national_id_father'    => 'required|unique:my_parents,national_id_father,' . $this->id,
            'passport_id_father'    => 'required|unique:my_parents,passport_id_father,' . $this->id,
            'phone_father'          => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blood_type_father_id'  => 'required',
            'religion_father_id'    => 'required',
            'address_father'        => 'required',
        ]);

        $this->currentStep = 2;
    }


    public function secondStepSubmit()
    {
        $this->validate([
            'name_mother'           => 'required',
            'name_mother_en'        => 'required',
            'national_id_mother'    => 'required|unique:my_parents,national_id_mother,' . $this->id,
            'passport_id_mother'    => 'required|unique:my_parents,passport_id_mother,' . $this->id,
            'phone_mother'          => 'required',
            'job_mother'            => 'required',
            'job_mother_en'         => 'required',
            'nationality_mother_id' => 'required',
            'blood_type_mother_id'  => 'required',
            'religion_mother_id'    => 'required',
            'address_mother'        => 'required',
        ]);

        $this->currentStep = 3;
    }


    public function back($step)
    {
        $this->currentStep = $step;
    }


    public function edit($id)
    {
        $this->update_mode = true;
        $this->show_table = false;
        $this->currentStep = 1;
        $my_parent = MyParent::findOrFail($id);

        $this->parent_id = $id;

         $this->email = $my_parent->email;
         $this->password = $my_parent->password;
         $this->job_father = $my_parent->getTranslation('job_father', 'ar');
         $this->job_father_en = $my_parent->getTranslation('job_father', 'en');
         $this->name_father = $my_parent->getTranslation('name_father', 'ar');
         $this->name_father_en = $my_parent->getTranslation('name_father', 'en');
         $this->national_id_father = $my_parent->national_id_father;
         $this->passport_id_father = $my_parent->passport_id_father;
         $this->phone_father = $my_parent->phone_father;
         $this->nationality_father_id = $my_parent->nationality_father_id;
         $this->blood_type_father_id = $my_parent->blood_type_father_id;
         $this->address_father = $my_parent->address_father;
         $this->religion_father_id = $my_parent->religion_father_id;
 
         $this->job_mother = $my_parent->getTranslation('job_mother', 'ar');
         $this->job_mother_en = $my_parent->getTranslation('job_mother', 'en');
         $this->name_mother = $my_parent->getTranslation('name_mother', 'ar');
         $this->name_mother_en = $my_parent->getTranslation('name_mother', 'en');
         $this->national_id_mother = $my_parent->national_id_mother;
         $this->passport_id_mother = $my_parent->passport_id_mother;
         $this->phone_mother = $my_parent->phone_mother;
         $this->nationality_mother_id = $my_parent->nationality_mother_id;
         $this->blood_type_mother_id = $my_parent->blood_type_mother_id;
         $this->address_mother = $my_parent->address_mother;
         $this->religion_mother_id = $my_parent->religion_mother_id;
    }

    public function firstStepSubmit_edit()
    {
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->currentStep = 3;
    }


    public function submitForm_edit()
    {
        $my_parent = MyParent::findOrFail($this->parent_id);

        $my_parent->update([
            'email'                 => $this->email,
            'password'              => Hash::make($this->password),
            'name_father'           => ['en' => $this->name_father_en, 'ar' => $this->name_father],
            'national_id_father'    => $this->national_id_father,
            'phone_father'          => $this->phone_father,
            'job_father'            => ['en' => $this->job_father_en, 'ar' => $this->job_father],
            'passport_id_father'    => $this->passport_id_father,
            'nationality_father_id' => $this->nationality_father_id,
            'blood_type_father_id'  => $this->blood_type_father_id,
            'religion_father_id'    => $this->religion_father_id,
            'address_father'        => $this->address_father,

            // Mother_INPUTS
            'name_mother'           => ['en' => $this->name_mother_en, 'ar' => $this->name_mother],
            'national_id_mother'    => $this->national_id_mother,
            'passport_id_mother'    => $this->passport_id_mother,
            'phone_mother'          => $this->phone_mother,
            'job_mother'            => ['en' => $this->job_mother_en, 'ar' => $this->job_mother],
            'nationality_mother_id' => $this->nationality_mother_id,
            'blood_type_mother_id'  => $this->blood_type_mother_id,
            'religion_mother_id'    => $this->religion_mother_id,
            'address_mother'        => $this->address_mother,
        ]);

      /*  if($this->photos && count($this->photos) > 0) {
            if(ParentAttachment::where('parent_id', $this->parent->id)->first()) {
                Storage::disk('parent_attachments')->deleteDirectory($this->national_id_father);
            }
            foreach ($this->photos as $photo) {
                $photo->storeAs($this->national_id_father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                ParentAttachment::create([
                    'file_name' => $photo->getClientOriginalName(),
                    'parent_id' => MyParent::latest()->first()->id,
                ]);
            }
        }*/

        $this->update_mode = false;
        $this->show_table = true;
    }


    public function delete($id)
    {
        $my_parent = MyParent::findOrFail($id);
        if(ParentAttachment::where('parent_id', $id)->first()) {
            Storage::disk('parent_attachments')->deleteDirectory($my_parent->national_id_father);
        }

        $my_parent->delete();
        $this->deleteMessage = trans('messages.delete');
        $this->show_table = true;
    }


     //clearForm
     public function clearForm()
     {
         $this->email = '';
         $this->password = '';
         $this->name_father = '';
         $this->job_father = '';
         $this->job_father_en = '';
         $this->name_father_en = '';
         $this->national_id_father ='';
         $this->passport_id_father = '';
         $this->phone_father = '';
         $this->nationality_father_id = '';
         $this->blood_type_father_id = '';
         $this->address_father ='';
         $this->religion_father_id ='';
 
         $this->name_mother = '';
         $this->job_mother = '';
         $this->job_mother_en = '';
         $this->name_mother_en = '';
         $this->national_id_mother ='';
         $this->passport_id_mother = '';
         $this->phone_mother = '';
         $this->nationality_mother_id = '';
         $this->blood_type_mother_id = '';
         $this->address_mother ='';
         $this->religion_mother_id =''; 

     }
}
