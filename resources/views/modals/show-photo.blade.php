
    <div class="modal-content no-padding">
        <div class="chage-avatar-modal no-padding row">
            <div class="col s9 center  show-photo-content" style="position: relative;">
                <div class="valign-wrapper">
                    @if(\File::exists($photo_info->original))
                        <img src="{{ asset($photo_info->original) }}" alt="photo-original" class="valign">
                    @else
                        <img src="{{ asset('img/photo_unavailable.jpg') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col s3 padding show-photo-comments">
                <div class="col s12 no-padding valign-wrapper">
                    <div class="col s2 no-padding" style="line-height:.5rem;">
                        <a href="{{ route('accound', encrypt($photo_info->user_id)) }}" class="truncate">
                            <img src="{{ asset($photo_info->user->profile->avatar->small) }}" alt="avatar" class="circle profile-image" />&nbsp;
                        </a>
                    </div>
                    <div class="col s10 no-padding mpadding-l">
                        <a href="{{ route('accound', encrypt($photo_info->user->id)) }}" style="text-transform:initial;">
                            <span class="truncate blue-text text-lighten-1">{{ $photo_info->user->user_name }}</span>
                        </a>
                        <small class="grey-text d-block"><i class="icon-time"></i> {{ !empty($photo_info->created_at) ? $photo_info->created_at->diffForHumans() : null }}</small>
                    </div>
                </div>
                <div class="col s12 no-padding">
                    <a href="#" class="mpadding {{\Pheaks\Http\Libraries\Checks::is_liked('photo',$photo_info->id) ? ' dislike-photo-button blue-text' : ' like-photo-button grey-text'}} text-lighten-1" data-photo="{{ encrypt($photo_info->id) }}">
                        <i class="icon-heart"></i> <span class="like-count">{{ isset($photo_info->likes) && !empty($photo_info->likes) ? $photo_info->likes()->where('status','1')->count() : '0' }}</span>
                    </a>
                    <span class="mpadding grey-text text-lighten-1">
                        <i class="icon-comment"></i> <span class="commnet-count">{{ isset($photo_info->comments) && !empty($photo_info->comments) ? $photo_info->comments()->count() : '0' }}</span>
                    </span>
                </div>
                <div class="col s12 no-padding show-comments margin-t">
                    @if(!empty($photo_info->comments()))
                    @foreach($photo_info->comments->reverse() as $key => $comment)
                    <div class="mpadding-b">
                        <div class="card-content">
                            <div class="row valign-wrapper no-margin">
                                <div class="col s2 no-padding" style="height: 3rem">
                                    <a href="{{ route('accound', encrypt($comment->user->id)) }}">
                                        <img src="{{ asset($comment->user->profile->avatar->small) }}" alt="avatar" width="30" class="circle profile-image" />&nbsp;
                                    </a>
                                </div>
                                <div class="col s10 no-padding mpadding-l">
                                    <a href="{{ route('accound', encrypt($comment->user->id)) }}">
                                        <span class="truncate blue-text text-lighten-1">{{ $comment->user->user_name }}</span>
                                    </a>
                                    <small class="grey-text">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <p class="no-margin mmargin-b">
                                {{ $comment->comment }}
                                {{--
                                @if($comment->file_id != null)
                                    <p class="no-margin">
                                        <img src="{{ Pheaks\Photo::find($comment->file_id )->small }}" alt="">
                                    </p>
                                @endif
                                --}}
                            </p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="divider"></div>
                <div class="col s12 no-padding">
                    {!! Form::open(['route'=>'commentphoto','class'=>'comment-photo-form']) !!}
                        <div class="row">
                            <div class="input-field col s12 no-padding">
                                <textarea id="textarea1" class="materialize-textarea no-padding" name="comment_photo_text"></textarea>
                                <label for="textarea1">Write comment...</label>
                            </div>
                            <div class="col s12">
                                <button type="submit" class="btn btn-block waves-light blue full-width">
                                    <i class="material-icons">send</i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="content_elment" value="{{ encrypt($photo_info->id) }}">
                    {!! Form::close() !!}
                </div>
                <a href="#!" class="modal-action modal-close">
                    <i class="icon-remove mdc-text-grey-300"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="modal-footer"></div>
