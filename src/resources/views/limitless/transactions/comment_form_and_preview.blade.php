<!-- transaction comments -->
@if (!empty($txn))
<div class="panel panel-flat no-border no-shadow hidden-print">
    <div class="panel-body no-padding-top pb-10" style="background: #f5f5f5">
        <table id="transaction_comments_table" class="table">
            <tbody>
            @foreach ($txn->comments as $index => $comment)
                @break($index > 1)
                <tr>
                    <td class="col-lg-1 text-nowrap text-muted text-size-mini">{{$comment->created_at}}</td>
                    <td class="">
                        <span class="btn btn-icon btn-rounded border-green btn-xs text-green-600"><i class="icon-file-text2"></i></span>
                    </td>
                    <td class="col-lg-10">
                        {{$comment->comment}}
                        {{--@if (!empty($comment['created_by']))<br>Created by $comment->created_by @endif--}}
                    </td>
                </tr>
            @endforeach

            <tr>
                <td class="col-lg-1 text-nowrap text-muted text-size-mini">{{$txn->created_on}}</td>
                <td class="">
                    <span class="btn btn-icon btn-rounded border-green btn-xs text-green-600"><i class="icon-file-check2"></i></span>
                </td>
                <td class="col-lg-10">
                    {{$txn->type->name}} of {{$txn->base_currency . ' ' . number_format($txn->total, $tenant->decimal_places)}}
                    @if (!empty($txn->created_by))
                        <div><span class="text-muted text-size-mini pl-10">Created by {{$txn->created_by}}</span></div>
                    @endif
                </td>
            </tr>

            <tr id="transaction_comment_form_tr" class="hidden">
                <td class="text-nowrap"  colspan="3">
                    <form id="transaction_comment_form" action="{{route('accounting.txn.comment.store')}}" method="post" class="form-horizontal">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="txn_id" value="{{$txn->id}}">
                        <div class="form-group mb-10">
                            <textarea name="comment" class="form-control input-roundless" rows="2" placeholder="Comment"></textarea>
                        </div>
                        <div class="form-group no-margin-bottom">
                            <button type="button" class="btn btn-danger btn-sm" onclick="rutatiina.txn_comment_form_ajax_submit('#transaction_comment_form', false);"><i class="icon-plus22"></i> Add Comment</button>
                            <button id="transaction_comment_form_cancel" type="button" class="btn btn-default btn-sm pull-right"><i class="icon-x"></i> Cancel</button>
                        </div>
                    </form>
                </td>
            </tr>
            <tr id="transaction_comment_add_link">
                <td class="text-nowrap"  colspan="3">
                    <a href="" class="text-size-small text-semibold"><i class="icon-plus22"></i> Add a comment</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endif