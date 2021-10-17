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
      $questionVideo= $this->uploadVideo('question_video');
      $data['question_video']=$questionVideo;
      $item=parent::create($data);

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
          if(isset($value['question'])){
              $required=isset($value['required'])&&$value['required']==1?1:0;
              $item->pollIdentifierQuestions()->create(['identifier_question'=>$value['question'],'required'=>$required]);
          }

       }
       foreach ($data['poll_option'] as $index=>$value) {
           $option=[];
           $optionVideo= $this->uploadVideo('video_'.$index);
           $option['question_option']=$value;
           if($optionVideo){
               $option['video']=$optionVideo;
           }

           $item->questionOptions()->create($option);
       }

     return true;
   }

   public function update($id, array $data)
   {
       $video= $this->uploadVideo('question_video');
       if($video){
           $data['question_video']=$video;
       }

     $item= parent::update($id,$data);
       foreach ($data['poll_option'] as $index=>$option){
           $questionOptions=[];
           $questionOptions=QuestionOptions::find($index);
           $optionVideo= $this->uploadVideo('video_'.$index);
           if($optionVideo){
               $questionOptions['video']=$optionVideo;
           }
           if($questionOptions&&$questionOptions['poll_id']==$id){
               $questionOptions['question_option']=$option;
               $questionOptions->save();

           }else{
               $item->questionOptions()->create(['question_option'=>$option]);
           }

       }
       foreach ($data['identifier_question'] as $index=>$question){
           $required=isset($question['required'])&&$question['required']==1?1:0;
           $identifyQuestion=PollIdentifierQuestion::find($index);
           if($identifyQuestion&&$identifyQuestion['poll_id']==$id){
               $identifyQuestion['identifier_question']=$question['question'];
               $identifyQuestion['required']=$required;
               $identifyQuestion->save();
           }else{
               $item->pollIdentifierQuestions()->create(['identifier_question'=>$question['question'],'required'=>$required]);
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
            return falsuploadVideoe;
        }

        return true;
    }
    public function uploadVideo($name)
    {
        if(Request()->hasFile($name)){
            $file = Request()->file($name);
            $filenamewithextension = request()->file($name)->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = request()->file($name)->getClientOriginalExtension();

            //filename to store
            $filenametostore = '_'.time().'.'.$extension;

            //Upload File
            request()->file($name)->storeAs('public/assets/uploads', $filenametostore);

            $url = 'storage/assets/uploads/'.$filenametostore;

            return $url;
        }
        return false;
    }

}
