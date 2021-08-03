<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\Models\Poll;


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
