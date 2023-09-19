<?php

namespace App\Http\Livewire;
 use App\Models\Nationalitie;
 use App\Models\Type_Blood;
 use App\Models\Religion;
 use App\Models\my__parents;
 use App\Models\parentAttachments;
 use Illuminate\Support\Facades\Hash;
 use Livewire\WithFileUploads;

use Livewire\Component;

class MyParentLivewire extends Component
{
    use WithFileUploads;

    public $catchError=false;
    public $successMessage = '',$show_table=true,$update_mode=false,$Parent_id;
    public $currentStep=1,  // Father_INPUTS
    $Email, $Password,
    $Name_Father, $Name_Father_en,
    $National_ID_Father, $Passport_ID_Father,
    $Phone_Father, $Job_Father, $Job_Father_en,
    $Nationality_Father_id, $Blood_Type_Father_id,

    $Address_Father, $Religion_Father_id, // Mother_INPUTS
    $Name_Mother, $Name_Mother_en,
    $National_ID_Mother, $Passport_ID_Mother,
    $Phone_Mother, $Job_Mother, $Job_Mother_en,
    $Nationality_Mother_id, $Blood_Type_Mother_id,
    $Address_Mother, $Religion_Mother_id,$photos;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[         'Email' => 'required|email',
        'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'Passport_ID_Father' => 'min:10|max:10',
        'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
'Passport_ID_Mother' => 'min:10|max:10',
'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }
    public function render()
    {
        return view('livewire.my-parent-livewire',[
            'Nationalities'=>Nationalitie::all(),
            'Type_Bloods'=>Type_Blood::all(),
            'Religions'=>Religion::all(),
            'my_parents'=>my__parents::all()
        ]);

    }
    public function firstStepSubmits(){
        $this->validate([
            'Email' => 'required',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required' ,
            'Passport_ID_Father' => 'required',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep=2;
    }
    public function secondStepSubmit(){
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required',
            'Passport_ID_Mother' => 'required',
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep=3;
    }

    public function submitForm(){
     try{

        $My_parent=new my__parents();
        $My_parent->email=$this->Email;
        $My_parent->password=Hash::make($this->Password);
        $My_parent->Name_Father=['ar'=>$this->Name_Father,'en'=>$this->Name_Father_en];
        $My_parent->Job_Father=['ar'=>$this->Job_Father,'en'=>$this->Job_Father_en];
        $My_parent->National_ID_Father=$this->National_ID_Father;
        $My_parent->Passport_ID_Father=$this->Passport_ID_Father;
        $My_parent->Phone_Father=$this->Phone_Father;
        $My_parent->Blood_Type_Father_id=$this->Blood_Type_Father_id;
        $My_parent->Religion_Father_id=$this->Religion_Father_id;
        $My_parent->Nationality_Father_id=$this->Nationality_Father_id;
        $My_parent->Address_Father=$this->Address_Father;
        $My_parent->Name_Mother=['ar'=>$this->Name_Mother,'en'=>$this->Name_Mother_en];
        $My_parent->National_ID_Mother=$this->National_ID_Mother;
        $My_parent->Passport_ID_Mother=$this->Passport_ID_Mother;
        $My_parent->Phone_Mother=$this->Phone_Mother;
        $My_parent->Job_Mother =['ar'=>$this->Job_Mother,'en'=>$this->Job_Mother_en];
        $My_parent->Religion_Mother_id=$this->Religion_Mother_id;
        $My_parent->Nationality_Mother_id=$this->Nationality_Mother_id;
        $My_parent->Blood_Type_Mother_id=$this->Blood_Type_Mother_id;
        $My_parent->Address_Mother=$this->Address_Mother;
        $My_parent->save();
        if(!empty($this->photos)){
            foreach($this->photos as $photo){
                $photo->storeAs($this->National_ID_Father,$photo->getClientOriginalName(),$disk='parent_attachments');
                parentAttachments::create([
                    'file_name'=>$photo->getClientOriginalName(),
                'parent_id'=>my__parents::latest()->first()->id,

                    ]) ;
            }
        }
        $this->successMessage=trans('messages.success');
        $this->clearForm();
        $this->currentStep=1;
     }

     catch (\Exception $e) {
        $this->catchError = $e->getMessage();
    };

    }
     //clearForm
     public function clearForm()
     {
         $this->Email = '';
         $this->Password = '';
         $this->Name_Father = '';
         $this->Job_Father = '';
         $this->Job_Father_en = '';
         $this->Name_Father_en = '';
         $this->National_ID_Father ='';
         $this->Passport_ID_Father = '';
         $this->Phone_Father = '';
         $this->Nationality_Father_id = '';
         $this->Blood_Type_Father_id = '';
         $this->Address_Father ='';
         $this->Religion_Father_id ='';

         $this->Name_Mother = '';
         $this->Job_Mother = '';
         $this->Job_Mother_en = '';
         $this->Name_Mother_en = '';
         $this->National_ID_Mother ='';
         $this->Passport_ID_Mother = '';
         $this->Phone_Mother = '';
         $this->Nationality_Mother_id = '';
         $this->Blood_Type_Mother_id = '';
         $this->Address_Mother ='';
         $this->Religion_Mother_id ='';

     }
     public function show_Add_form(){
        return $this->show_table=false;
     }
     public function edit($id){
        // dd($id);
      $this->show_table=false;
      $this->update_mode=true;
      $My_parent=my__parents::where('id',$id)->first();
      $this->Parent_id=$id;
      $this->Email = $My_parent->email;
      $this->Password = $My_parent->password;
      $this->Name_Father = $My_parent->getTranslation('Name_Father','ar');
      $this->Job_Father =$My_parent->getTranslation('Job_Father','ar');
      $this->Job_Father_en =$My_parent->getTranslation('Job_Father','en');
      $this->Name_Father_en = $My_parent->getTranslation('Name_Father','en');
      $this->National_ID_Father =$My_parent->National_ID_Father;
      $this->Passport_ID_Father = $My_parent->Passport_ID_Father;
      $this->Phone_Father = $My_parent->Phone_Father;
      $this->Nationality_Father_id = $My_parent->Nationality_Father_id;
      $this->Blood_Type_Father_id = $My_parent->Blood_Type_Father_id;
      $this->Address_Father =$My_parent->Address_Father;
      $this->Religion_Father_id =$My_parent->Religion_Father_id;

      $this->Name_Mother = $My_parent->getTranslation('Name_Mother','ar');
      $this->Job_Mother = $My_parent->getTranslation('Job_Mother','ar');;
      $this->Job_Mother_en = $My_parent->getTranslation('Job_Mother','en');;
      $this->Name_Mother_en = $My_parent->getTranslation('Name_Mother','en');
      $this->National_ID_Mother =$My_parent->National_ID_Mother;
      $this->Passport_ID_Mother = $My_parent->Passport_ID_Mother;
      $this->Phone_Mother =$My_parent->Phone_Mother ;
      $this->Nationality_Mother_id = $My_parent->Nationality_Mother_id;
      $this->Blood_Type_Mother_id = $My_parent->Blood_Type_Mother_id;
      $this->Address_Mother =$My_parent->Address_Mother;
      $this->Religion_Mother_id =$My_parent->Religion_Mother_id;
     }
    public function EditFirstSubmits(){

        $this->validate([
            'Email' => 'required',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required' ,
            'Passport_ID_Father' => 'required',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep=2;
    }
    public function EditScondeSubmits(){
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required',
            'Passport_ID_Mother' => 'required',
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->update_mode=true;

        $this->currentStep=3;
    }
    public function submitForm_edit(){
       $parent_id=$this->Parent_id;
     if($parent_id){
        $parents=my__parents::find($parent_id);
        $parents->update([

            'email'=>$this->Email,
            'password'=>Hash::make($this->Password),
            'Name_Father'=>['ar'=>$this->Name_Father,'en'=>$this->Name_Father_en],
            'Job_Father'=>['ar'=>$this->Job_Father,'en'=>$this->Job_Father_en],
            'National_ID_Father'=>$this->National_ID_Father,
            'Passport_ID_Father'=>$this->Passport_ID_Father,
            'Phone_Father'=>$this->Phone_Father,
            'Blood_Type_Father_id'=>$this->Blood_Type_Father_id,
            'Religion_Father_id'=>$this->Religion_Father_id,
            'Nationality_Father_id'=>$this->Nationality_Father_id,
            'Address_Father'=>$this->Address_Father,
            'Name_Mother'=>['ar'=>$this->Name_Mother,'en'=>$this->Name_Mother_en],
            'National_ID_Mother'=>$this->National_ID_Mother,
            'Passport_ID_Mother'=>$this->Passport_ID_Mother,
            'Phone_Mother'=>$this->Phone_Mother,
            'Job_Mother'=>['ar'=>$this->Job_Mother,'en'=>$this->Job_Mother_en],
            'Religion_Mother_id'=>$this->Religion_Mother_id,
            'Nationality_Mother_id'=>$this->Nationality_Mother_id,
            'Blood_Type_Mother_id'=>$this->Blood_Type_Mother_id,
            'Address_Mother'=>$this->Address_Mother,

        ]);
        $parents->save();
        $this->successMessage=trans('messages.success');
        $this->clearForm();
    return redirect('/add_parent');

     }


     }
    //  delete methode

     public function delete($id){
        $parents=my__parents::findOrFail($id);
        $parents->delete();
        // $this->successMessage=trans('messages.Delete');
    //return redirect('/add_parent');
    return redirect()->to('/add_parent');

    }
    public function back(){
        $this->currentStep--;
    }
}

