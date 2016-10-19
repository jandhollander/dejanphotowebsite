<div class="jumbotron">
    <h1>Heb je een vraag voor me?</h1>
    <h4>... of een suggestie, misschien?</h4>
    <p>Je kan me op verschillende manieren contacteren:</p>
    
    <div class="btn-group" role="group">
        <a href="http://facebook.com/dejanphotobe" target="contact">
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Facebook</button>
        </a>
        <a href="https://instagram.com/dejanphotobe" target="contact">
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-camera"></span> Instagram</button>
        </a>
        <a href="#" target="contact" data-toggle="modal" data-target="#email">
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> Email</button>
        </a>
    </div>
    
    
    <div id="email" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Stuur een email...</h4>
                </div>
                <form action="sendMail.php" onsubmit="sendEmail(this); $('#emailFields').hide(); $('#emailConfirm').show(); return false;">
                    <div class="modal-body">
                        <ul id="emailFields" class="list-group">
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" name="name" class="form-control" placeholder="Jouw naam" required aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">@</span>
                                    <input type="email" name="email" class="form-control" placeholder="Jouw email adres" required aria-describedby="basic-addon1">
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <textarea rows="10" cols="59" name="message" placeholder="Typ hier je bericht" required/>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-primary">Verzend</button>
                            </li>
                        </ul>
                        <div id="emailConfirm" style="display: none">
                            <div class="alert alert-success" role="alert">
                                Je bericht is verzonden!
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Sluiten</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


<div class="fb-page" data-href="https://www.facebook.com/dejanphotobe" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/dejanphotobe"><a href="https://www.facebook.com/dejanphotobe">DeJan Photography</a></blockquote></div></div>