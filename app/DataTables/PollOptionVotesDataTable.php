<?php

namespace App\DataTables;

use App\Models\Poll;
use App\Models\PollIdentifierAnswer;
use App\Models\PollVote;
use App\Models\QuestionOptions;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PollOptionVotesDataTable extends DataTable
{
    protected $index;
    public $identifyAnswer;
    public $userId;
    public $answerId=[];
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $return= datatables()
            ->eloquent($query)
            ->addColumn('answer', function($item){
                return $this->selected->question_option;
            })

            ->rawColumns(['answer'])
            ->addColumn('#', function($item){
                $this->userId=$item->user_id;
                $this->index=$this->index+1;
                return $this->index;
            });

        foreach($this->pollIdentifierQuestions as $index=>$IdentifierQuestion){
            $this->identifyAnswer=$IdentifierQuestion->id;
            $required=$IdentifierQuestion->required==1?'<span style="color: red"> * </span>':'';
            $return=$return->addColumn($IdentifierQuestion->identifier_question.$required, function($item) use($IdentifierQuestion){
                $identifyAnswer=PollIdentifierAnswer::where('user_id', $this->userId)->where('identifier_question_id', $IdentifierQuestion->id)->get();
                foreach($identifyAnswer as $answer){
                    if($IdentifierQuestion->id==$answer->identifier_question_id && !in_array($answer->id, $this->answerId)){
                        array_push( $this->answerId,$answer->id);
                        return $answer->answer;
                    }
                }

            });

        }
        return $return;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PollVote $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PollVote $model)
    {
        return $model->OptionsVotes($this->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('customer-option-vote-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $column=[Column::make('#')];
        foreach($this->pollIdentifierQuestions as $IdentifierQuestion){
            $required=$IdentifierQuestion->required==1?'<span style="color: red"> * </span>':'';
            $add=Column::make($IdentifierQuestion->identifier_question.$required);
            array_push($column,$add);
        }
        $adds=Column::make('answer');
        array_push($column,$adds);

        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Poll_' . date('YmdHis');
    }
}