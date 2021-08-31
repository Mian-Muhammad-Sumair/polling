<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\Exports\PollKeysExport;
use App\Models\Poll;
use App\Models\PollIdentifierQuestion;
use App\Models\QuestionOptions;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Facades\Excel;


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

//     $key=[];
       if($data['status']=='Published') {
           if(isset($data['key_type'])&&$data['key_type']==1){
               for ($i = 0; $i < 2; $i++) {
                   $newKew = Str::random(30);
                   $item->pollKeys()->create(['key'=>$newKew]);
               }
           }
           $item->pollKeys()->create(['key' => $data['key']]);
       }
       foreach ($data['identifier_question'] as $value) {
           $item->pollIdentifierQuestions()->create(['identifier_question'=>$value]);
       }
       foreach ($data['poll_option'] as $value) {
           $item->questionOptions()->create(['question_option'=>$value]);
       }

     return true;
   }

   public function update($id, array $data)
   {

     $item= parent::update($id,$data);
       foreach ($data['poll_option'] as $index=>$option){
           $questionOptions=QuestionOptions::find($index);
           if($questionOptions&&$questionOptions['poll_id']==$id){
               $questionOptions['question_option']=$option;
               $questionOptions->save();

           }else{
               $item->questionOptions()->create(['question_option'=>$option]);
           }

       }
       foreach ($data['identifier_question'] as $index=>$question){
           $identifyQuestion=PollIdentifierQuestion::find($index);
           if($identifyQuestion&&$identifyQuestion['poll_id']==$id){
               $identifyQuestion['identifier_question']=$question;
               $identifyQuestion->save();
           }else{
               $item->pollIdentifierQuestions()->create(['identifier_question'=>$question]);
           }
       }
     $item->pollKeys()->delete();
       foreach ($data['key'] as $value) {
           $item->pollKeys()->create(['key'=>$value]);
       }
       return true;
   }
    public function delete($id)
    {
        $user_id=auth()->id();
        $poll=Poll::where('id',$id)->where('user_id',$user_id)->first();
        if($poll){
            $pollVote=Poll::PollVotes($id);
            $pollVote=collect($pollVote)->sum('total_Vote');
           if($pollVote==0){
               $item= parent::delete($id);
               $item->pollKeys()->delete();
               $item->pollIdentifierQuestions()->delete();
               $item->questionOptions()->delete();

           }else{
               return false;
           }

        }else{
            return false;
        }

        return true;
    }

}
