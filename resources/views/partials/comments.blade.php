<div class="row ">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title ">
                      <!-- <span class="glyphicon glyphicon-comment"></span> -->
                      <a href="#showcomments" data-toggle="collapse"><i class="fas fa-comments"></i> Resent Comments </a>
                    </h3>
                  </div>
                  <div class="panel-body collapse" id="showcomments">
                    <ul class="media-list">
                  
                      @foreach($comments as $comment)
                          <li class="media">
                          <div class="media-left">
                            <img src="http://placeholde.it/60x60" class="img-circle">
                          </div>
                        <div class="media-body">
                          <h4 class=media-heading>
                            
                            <small>
                            <a href="users/{{$comment->user->id}}" >{{$comment->user->first_name}} {{ $comment->user->last_name }} - {{$comment->user->email}} </a>
                            <br>
                            commented on {{ $comment->created_at}}
                            </small>
                          </h4>
                          <p>
                          {{ $comment->body}}
                          </p>
                        <i>Proof:</i>
                          <p class="text-primary">
                          {{ $comment->url}}
                          </p>
                        </div>
                        </li>
                      @endforeach
                      
                    </ul>
                  </div>
                  </div>
              </div>
            </div>
        </div>