<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\Models\Poll;
use Illuminate\Support\Str;


class PollRepository extends BaseCRUDRepository implements PollRepositoryInterface
{
   public function setup()
   {
       $this->setModel(Poll::class);
//       $this->setIndexWiths(['user']);
//       $this->setShowWiths(['user']);
//       $this->setRelated(['user']);
   }

   public function create(array $data)
   {
     $item=parent::create($data);
       if(isset($data['key_type'])&&$data['key_type']==1){
           for ($i = 0; $i < 2; $i++) {
               $newKew = Str::random(30);
               $item->pollKeys()->create(['key'=>$newKew]);
           }
       }
       $item->pollKeys()->create(['key'=>$data['key']]);

       foreach ($data['identifier_question'] as $value) {
           $item->pollIdentifierQuestions()->create(['identifier_question'=>$value]);
       }
       foreach ($data['poll_option'] as $value) {
           $item->questionsOptions()->create(['question_option'=>$value]);
       }

     return true;
   }

   public function update($id, array $data)
   {
     $item= parent::update($id,$data);
     $item->questionsOptions()->delete();
       foreach ($data['poll_option'] as $value) {
           $item->questionsOptions()->create(['question_option'=>$value]);
       }
       return true;
   }

}
