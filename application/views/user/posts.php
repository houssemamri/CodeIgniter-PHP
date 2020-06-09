<section data-cont="<?= $selected_accounts ?>" data-up="<?= (get_option('upload_limit'))?get_option('upload_limit'):'6'; ?>" data-act="<?= (get_option('posts_planner_limit'))?get_option('posts_planner_limit'):'1'; ?>">
    <?= form_open('user/posts', ['class' => 'send-post']) ?>
    <div class="container-fluid posts">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left">
           <div class="col-lg-12 emojies clean" style="display:none;">
                <div class="panel">
                    <div class="panel-heading">
                        <ul class="nav">
                           <li class=" nav-item active"><a href="#emojies-peoples" data-toggle="tab" class="emoji-cat">😎‍</a></li>
                           <li class="nav-item"><a href="#emojies-animals" data-toggle="tab" class="nav-link emoji-cat">🙉</a></li>
                           <li class="nav-item"><a href="#emojies-food" data-toggle="tab" class="nav-link emoji-cat">🍔</a></li>
                           <li class="nav-item"><a href="#emojies-sport" data-toggle="tab" class="nav-link emoji-cat">🏀</a></li>
                           <li class="nav-item"><a href="#emojies-travel" data-toggle="tab" class="nav-link emoji-cat">🚢</a></li>
                           <li class="nav-item"><a href="#emojies-signs" data-toggle="tab" class="nav-link emoji-cat">🔱</a></li>
                           <li class="nav-item"><a href="#emojies-objects" data-toggle="tab" class="nav-link emoji-cat">📻</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="emojies-peoples">
                                <table>
                                    <tr>
                                        <td><a href="😀">😀</a></td>
                                        <td><a href="😁">😁</a></td>
                                        <td><a href="😂">😂</a></td>
                                        <td><a href="😃">😃</a></td>
                                        <td><a href="😄">😄</a></td>
                                        <td><a href="😅">😅</a></td>
                                        <td><a href="😆">😆</a></td>
                                        <td><a href="😉">😉</a></td>
                                        <td><a href="😊">😊</a></td>
                                        <td><a href="😋">😋</a></td>                                        
                                    </tr>
                                    <tr>
                                        <td><a href="😎">😎</a></td>
                                        <td><a href="😍">😍</a></td>
                                        <td><a href="😘">😘</a></td>
                                        <td><a href="😗">😗</a></td>
                                        <td><a href="😙">😙</a></td>
                                        <td><a href="💋">💋</a></td>
                                        <td><a href="😟">😟</a></td>
                                        <td><a href="👦">👦</a></td>
                                        <td><a href="😕">😕</a></td>
                                        <td><a href="😥">😥</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="😮">😮</a></td>
                                        <td><a href="👲">👲</a></td>
                                        <td><a href="😯">😯</a></td>
                                        <td><a href="😴">😴</a></td>
                                        <td><a href="😌">😌</a></td>
                                        <td><a href="👦">👦</a></td>
                                        <td><a href="😲">😲</a></td>
                                        <td><a href="😷">😷</a></td>
                                        <td><a href="😤">😤</a></td>
                                        <td><a href="😩">😩</a></td>                                        
                                    </tr>
                                    <tr>
                                        <td><a href="😱">😱</a></td>
                                        <td><a href="👶">👶</a></td>
                                        <td><a href="👧">👧</a></td>
                                        <td><a href="🚶">🚶</a></td>
                                        <td><a href="💏">💏</a></td>
                                        <td><a href="😭">‍‍😭</a></td>
                                        <td><a href="😏">😏</a></td>
                                        <td><a href="🗣">🗣</a></td>
                                        <td><a href="🙌">‍🙌</a></td>
                                        <td><a href="😎">😎</a></td>                                        
                                    </tr>						
                                </table>
                            </div>
                            <div class="tab-pane fade" id="emojies-animals">
                                <table>
                                    <tr>
                                        <td><a href="🙉">🙉</a></td>
                                        <td><a href="🐻">🐻</a></td>
                                        <td><a href="🐼">🐼</a></td>
                                        <td><a href="🙈">🙈</a></td>
                                        <td><a href="🐴">🐴</a></td>
                                        <td><a href="🐛">🐛</a></td>
                                        <td><a href="🐆">🐆</a></td>
                                        <td><a href="🐅">🐅</a></td>
                                        <td><a href="🐃">🐃</a></td>
                                        <td><a href="🐘">🐘</a></td>                                        
                                    </tr>
                                    <tr>
                                        <td><a href="🐒">🐒</a></td>
                                        <td><a href="🐶">🐶</a></td>
                                        <td><a href="🐪">🐪</a></td>
                                        <td><a href="🐔">🐔</a></td>
                                        <td><a href="🐢">🐢</a></td>
                                        <td><a href="🐍">🐍</a></td>
                                        <td><a href="🐜">🐜</a></td>
                                        <td><a href="🐫">🐫</a></td>
                                        <td><a href="🐧">🐧</a></td>
                                        <td><a href="🐇">🐇</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="🐩">🐩</a></td>
                                        <td><a href="🐱">🐱</a></td>
                                        <td><a href="🐺">🐺</a></td>
                                        <td><a href="🐂">🐂</a></td>
                                        <td><a href="🐷">🐷</a></td>
                                        <td><a href="☃">☃</a></td>
                                        <td><a href="🐑">🐑</a></td>
                                        <td><a href="🐌">🐌</a></td>
                                        <td><a href="🐠">🐠</a></td>
                                        <td><a href="🐦">🐦</a></td>                                       
                                    </tr>			
                                </table>
                            </div>
                            <div class="tab-pane fade" id="emojies-food">
                                <table>
                                    <tr>
                                        <td><a href="🍞">🍞</a></td>
                                        <td><a href="🍯">🍯</a></td>
                                        <td><a href="🍹">🍹</a></td>
                                        <td><a href="🍼">🍼</a></td>
                                        <td><a href="☕️">☕️</a></td>
                                        <td><a href="🍗">🍗</a></td>
                                        <td><a href="🍻">🍻</a></td>
                                        <td><a href="🍟">🍟</a></td>
                                        <td><a href="🍕">🍕</a></td>
                                        <td><a href="🍫">🍫</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="🍩">🍩</a></td>
                                        <td><a href="🍲">🍲</a></td>
                                        <td><a href="🍭">🍭</a></td>
                                        <td><a href="🍚">🍚</a></td>
                                        <td><a href="🍤">🍤</a></td>
                                        <td><a href="🍦">🍦</a></td>
                                        <td><a href="🎂">🎂</a></td>
                                        <td><a href="🍮">🍮</a></td>
                                        <td><a href="🍷">🍷</a></td>
                                        <td><a href="🍜">🍜</a></td>                                        
                                    </tr>																		
                                    <tr>
                                        <td><a href="🍔">🍔</a></td>
                                        <td><a href="🍇">🍇</a></td>
                                        <td><a href="🍈">🍈</a></td>
                                        <td><a href="🍉">🍉</a></td>
                                        <td><a href="🍊">🍊</a></td>
                                        <td><a href="🍋">🍋</a></td>
                                        <td><a href="🍍">🍍</a></td>
                                        <td><a href="🍎">🍎</a></td>
                                        <td><a href="🍏">🍏</a></td>
                                        <td><a href="🍒">🍒</a></td>                                        
                                    </tr>		
                                    <tr>
                                        <td><a href="🍓">🍓</a></td>
                                        <td><a href="🍬">🍬</a></td>
                                        <td><a href="🍅">🍅</a></td>
                                        <td><a href="🍺">🍺</a></td>
                                        <td><a href="🍆">🍆</a></td>
                                        <td><a href="🍻">🍻</a></td>
                                        <td><a href="🍸">🍸</a></td>
                                        <td><a href="🌽">🌽</a></td>
                                        <td><a href="🍥">🍥</a></td>
                                        <td><a href="🍄">🍄</a></td>                                        
                                    </tr>										
                                </table>
                            </div>
                            <div class="tab-pane fade" id="emojies-sport">
                                <table>
                                    <tr>
                                        <td><a href="⛷">⛷</a></td>
                                        <td><a href="🎹">🎹</a></td>
                                        <td><a href="🚴">🚴</a></td>
                                        <td><a href="🏊‍">🏊‍</a></td>
                                        <td><a href="🎿">🎿</a></td>
                                        <td><a href="🎷">🎷</a></td>
                                        <td><a href="⚾">⚾</a></td>
                                        <td><a href="🏀">🏀</a></td>
                                        <td><a href="🏆">🏆</a></td>
                                        <td><a href="⛹">⛹</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="🎺">🎺</a></td>
                                        <td><a href="🏈">🏈</a></td>
                                        <td><a href="🏉">🏉</a></td>
                                        <td><a href="🎾">🎾</a></td>
                                        <td><a href="🎱">🎱</a></td>
                                        <td><a href="🎳">🎳</a></td>
                                        <td><a href="🎸">🎸</a></td>
                                        <td><a href="🎯">🎯</a></td>
                                        <td><a href="⛳">⛳</a></td>
                                        <td><a href="⛸">⛸</a></td>                                        
                                    </tr>																		
                                    <tr>
                                        <td><a href="🎣">🎣</a></td>
                                        <td><a href="⛏">⛏</a></td>
                                        <td><a href="🎲">🎲</a></td>
                                        <td><a href="♖">♖️</a></td>
                                        <td><a href="🏇">🏇</a></td>
                                        <td><a href="🎣">🎣</a></td>
                                        <td><a href="🏄">🏄</a></td>
                                        <td><a href="♜">♜</a></td>
                                        <td><a href="⛺">⛺</a></td>
                                        <td><a href="🏄">🏄</a></td>                                        
                                    </tr>										
                                </table>
                            </div>
                            <div class="tab-pane fade" id="emojies-travel">
                                <table>
                                    <tr>
                                        <td><a href="🚗">🚗</a></td>
                                        <td><a href="🚣">🚣</a></td>
                                        <td><a href="🚌">🚌</a></td>
                                        <td><a href="🚢">🚢</a></td>
                                        <td><a href="🚃">🚃</a></td>
                                        <td><a href="🚍">🚍</a></td>
                                        <td><a href="🚤">🚤</a></td>
                                        <td><a href="✈">✈</a></td>
                                        <td><a href="🎑">🎑</a></td>
                                        <td><a href="🌄">🌄</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="🚆">🚆</a></td>
                                        <td><a href="🚁">🚁</a></td>
                                        <td><a href="🚲">🚲</a></td>
                                        <td><a href="⛵">⛵</a></td>
                                        <td><a href="🚂">🚂</a></td>
                                        <td><a href="⛺️">⛺️</a></td>
                                        <td><a href="🚡">🚡</a></td>
                                        <td><a href="🗽">🗽</a></td>
                                        <td><a href="🗼">🗼</a></td>
                                        <td><a href="🏰">🏰</a></td>                                        
                                    </tr>										
                                </table>
                            </div>
                            <div class="tab-pane fade" id="emojies-signs">
                                <table>
                                    <tr>
                                        <td><a href="🚸">🚸</a></td>
                                        <td><a href="📵">📵</a></td>
                                        <td><a href="⛔️">‍⛔️</a></td>
                                        <td><a href="🚾">🚾‍</a></td>
                                        <td><a href="🛂">🛂</a></td>
                                        <td><a href="♻️">♻️</a></td>
                                        <td><a href="🔕">🔕</a></td>
                                        <td><a href="❇️">❇️</a></td>
                                        <td><a href="⚠️">⚠️</a></td>
                                        <td><a href="🔀">🔀</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="➡️">➡️</a></td>
                                        <td><a href="☑️">☑️</a></td>
                                        <td><a href="📶">📶</a></td>
                                        <td><a href="📮">📮</a></td>
                                        <td><a href="🚮">🚮</a></td>
                                        <td><a href="🔄">🔄️</a></td>
                                        <td><a href="🚰">🚰</a></td>
                                        <td><a href="♿">♿</a></td>
                                        <td><a href="🚹">🚹</a></td>
                                        <td><a href="🚺">🚺</a></td>                                        
                                    </tr>																		
                                    <tr>
                                        <td><a href="🚼">🚼️</a></td>
                                        <td><a href="🔙">🔙️</a></td>
                                        <td><a href="🔝">🔝</a></td>
                                        <td><a href="🔛">🔛️</a></td>
                                        <td><a href="✔️">✔️</a></td>
                                        <td><a href="🅿️">🅿️</a></td>
                                        <td><a href="☜">☜</a></td>
                                        <td><a href="☟">☟</a></td>
                                        <td><a href="🔱">🔱</a></td>
                                        <td><a href="💲">💲</a></td>                                        
                                    </tr>										
                                </table>                                
                            </div>
                            <div class="tab-pane fade" id="emojies-objects">
                                <table>
                                    <tr>
                                        <td><a href="💎">💎</a></td>
                                        <td><a href="☎️">☎️</a></td>
                                        <td><a href="🌈">‍🌈</a></td>
                                        <td><a href="⚱">⚱‍</a></td>
                                        <td><a href="⚙">⚙</a></td>
                                        <td><a href="🔑">🔑</a></td>
                                        <td><a href="✂">✂</a></td>
                                        <td><a href="📌">📌</a></td>
                                        <td><a href="📉">📉</a></td>
                                        <td><a href="📈">📈</a></td>                                        
                                    </tr>	
                                    <tr>
                                        <td><a href="📅">📅</a></td>
                                        <td><a href="📆">📆</a></td>
                                        <td><a href="📁">📁</a></td>
                                        <td><a href="📮">📮</a></td>
                                        <td><a href="📭">📭</a></td>
                                        <td><a href="💳">💳️</a></td>
                                        <td><a href="📺">📺</a></td>
                                        <td><a href="💰">💰</a></td>
                                        <td><a href="📜">📜</a></td>
                                        <td><a href="📚">📚</a></td>                                        
                                    </tr>																		
                                    <tr>
                                        <td><a href="⌚️">⌚️</a></td>
                                        <td><a href="📷">📷️</a></td>
                                        <td><a href="📱">📱</a></td>
                                        <td><a href="🏁">🏁️</a></td>
                                        <td><a href="📻">📻</a></td>
                                        <td><a href="💣">💣</a></td>
                                        <td><a href="💰">💰</a></td>
                                        <td><a href="🎥">🎥</a></td>
                                        <td><a href="💵">💵‍</a></td>
                                        <td><a href="💶">💶</a></td>                                        
                                    </tr>										
                                </table>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea class="new-post form-control" rows="5" placeholder="<?= $this->lang->line('mu24'); ?>"></textarea>
							<?php
							if (isset($options["enable-emojis"])):
							    ?>
                                <div class="show-emoji"><i class="fa fa-smile-o" aria-hidden="true"></i></div>
							    <?php
							endif;
							?>
                            <div class="numchar">0</div>
                            <div class="show-title"><i class="fa fa-plus-square"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row post-title">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" placeholder="<?= $this->lang->line('mu25'); ?>" class="form-control post-title">
                        </div>
                    </div>
                </div>
            </div>
			<?php
			if(isset($options['enable_tools_page']) && get_user_option('display_preview_box')) {
			?>
            <div class="col-lg-12 widget spintax">
                <div class="row">
                    <div class="panel-heading">
					    <i class="fa fa-language"></i> <?= $this->lang->line('mu296') ?>
						<div class="btn-group pull-right"><button type="button" data-type="main" class="btn btn-default spin-refresh"><i class="fa fa-refresh"></i></button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 post-plans">
					    <textarea class="syntax-preview form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                </div>
            </div>
			<?php
			}
			?>
            <div class="col-lg-12 clean">
                <div class="panel">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#link2" data-toggle="tab" class="url-link nav-link active" role="tab" aria-controls="link2" aria-selected="true"><i class="fa fa-link"></i></a></li>
                           <li class="nav-item"><a href="#image" data-toggle="tab" class="image nav-link" role="tab" aria-controls="image" aria-selected="false"><i class="fa fa-picture-o"></i></a></li>
						   <?php 
						   if (isset($options["enable-video-uplodad"])):
						   ?>
                           <li class="nav-item"><a  href="#video" data-toggle="tab" class="video nav-link" role="tab" aria-controls="video" aria-selected="false"><i class="fa fa-video-camera"></i></a></li>
						   <?php
						   endif;
						   ?>
                           <img src="<?= base_url(); ?>assets/img/load-prev2.gif" class="loading-image">
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="link2">
                                <div class="col-lg-12 clean link">
                                    <a href="" target="_blank"></a>
                                    <input type="text" class="form-control url">
                                    <button title="<?= $this->lang->line('mu26'); ?>" class="pull-right insert delete-link" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    <button title="<?= $this->lang->line('mu27'); ?>" class="pull-right insert insert-link" type="button"><i class="fa fa-upload"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="<?= $this->lang->line('mu28'); ?>" class="form-control the-link">
                                    <span class="input-group-btn">
                                        <button class="btn add-link" type="button"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                                <p class="parse-load"><?= $this->lang->line('mu29'); ?></p>
                            </div>
                            <div class="tab-pane fade" id="image">
                                <div class="col-lg-12 clean img">
                                    <a href="" target="_blank"></a>
                                    <input type="text" class="form-control aimg">
                                    <button title="<?= $this->lang->line('mu30'); ?>" class="pull-right insert delete-img" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    <button title="<?= $this->lang->line('mu31'); ?>" class="pull-right insert insert-img" type="button"><i class="fa fa-upload"></i></button>
                                    <button title="<?= $this->lang->line('mu32'); ?>" class="pull-right insert crop-img" data-toggle="modal" data-target="#crop-img" type="button"><i class="fa fa-crop" aria-hidden="true"></i></button>
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="<?= $this->lang->line('mu33'); ?><?php if (isset($options["enable-image-uplodad"])): ?> <?= $this->lang->line('mu34'); ?><?php endif; ?>" class="form-control the-img">
                                    <span class="input-group-btn">
                                        <?php if (isset($options["enable-image-uplodad"])): ?>
                                            <button class="btn imgup" data-type="image" type="button"><i class="fa fa-picture-o"></i></button>
                                            <?php
                                        endif;
                                        ?>
                                        <button class="btn add-img" type="button"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
								<div class="col-lg-12 clean media-gallery media-gallery-images" data-type="image">
								</div>
								<div class="col-lg-12 clean media-gallery media-gallery-pagination" data-type="image">
								    <div class="btn-group btn-group-info pull-left">
	                                    <button class="btn btn-default disabled media-images-back" type="button"><i class="fa fa-angle-left"></i></button>
									    <button class="btn btn-default disabled media-images-next" type="button"><i class="fa fa-angle-right"></i></button>
								    </div>
									<span class="pull-right total-gallery-photos"></span>
								</div>
                            </div>
							<?php
							if (isset($options["enable-video-uplodad"])):
							?>
                            <div class="tab-pane fade" id="video">
                                <div class="col-lg-12 clean vid">
                                    <a href="" target="_blank"></a>
                                    <button title="<?= $this->lang->line('mu35'); ?>" class="pull-right insert delete-vid" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    <button title="<?= $this->lang->line('mu36'); ?>" class="pull-right insert insert-vid" type="button"><i class="fa fa-upload"></i></button>
                                    <input type="text" class="form-control avid">
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="<?= $this->lang->line('mu37'); ?>" class="form-control the-video" disabled="disabled">
                                    <span class="input-group-btn">
                                        <button class="btn imgup" data-type="video" type="button"><i class="fa fa-video-camera"></i></button>
                                        <button class="btn add-vid" type="button"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
								<div class="col-lg-12 clean media-gallery media-gallery-videos" data-type="video">
								</div>
								<div class="col-lg-12 clean media-gallery video-gallery-pagination" data-type="video">
								    <div class="btn-group btn-group-info pull-left">
	                                    <button class="btn btn-default disabled media-videos-back" type="button"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
									    <button class="btn btn-default disabled media-videos-next" type="button"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
								    </div>
									<span class="pull-right total-gallery-videos"></span>
								</div>
                            </div>
							<?php
							endif;
							?>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			if(isset($options['tool_groups-accounts']) && get_user_option('display_groups_form')) {
			    get_instance()->load->helper('second_helper');
				show_groups();
			} else {
			?>
            <div class="col-lg-12 social">
				<?php
                $categories = [];
				
                if($networks)
                {
					echo '<ul>';?>
					
					<?php
                    foreach ($networks as $net) {
				
					    if ( check_plan_networks(strtolower($net["network_name"])) == FALSE ) {
							continue;
						}
                        if (($net["expires"] == "0") || ($net["expires"] == "") || ($net["expires"] > strtotime(date('Y-m-d h:i:s'))))
                        {
                            $details = get_network_details(ucfirst($net["network_name"]));
                            ?>
                            <li class="netsel" data-network="<?= $net["network_name"]; ?>">
                                <span class="icon pull-left" style="background-color:<?= $details["network"]->color ?>"><?= $details["network"]->icon ?></span> <span class="netaccount pull-left"><?= ucwords(str_replace("_"," ",$net["network_name"])); ?><i><?php if (isset($options["enable-video-uplodad"])): echo $details["network"]->types; else: echo str_replace(', videos','',$details["network"]->types); endif;  ?></i></span>
                                <div class="btn-group pull-right">
								<?php if($net["network_name"]=='google_mybusiness')
						{?>
                                    <button type="button" data-type="main" class="btn btn-default mybusiness_select_net">
									<?= $this->lang->line('mu42'); ?>
									 </button>
						<?php } else{ ?>
						  <button type="button" data-type="main" class="btn btn-default select-net">
						  <?= $this->lang->line('mu42'); ?>
									 </button>
						<?php } ?>
                                        
                                   
                                    <button type="button" class="btn btn-default show-accounts">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
							
                            <li class="socials" data-network="<?= $net["network_name"]; ?>">
                               <div class="row">
                                   <div class="col-lg-12"><i class="fa fa-search" aria-hidden="true"></i><input class="search-accounts form-control" placeholder="<?= $this->lang->line('mu38'); ?>" /><button class="show-selected" type="button"><i class="fa fa-times" aria-hidden="true"></i></button></div>
                               </div>
                               <div class="row">
                                   <div class="col-lg-12">
                                       <ul class="sell-accounts">
                                          <?php
                                          if(count($details["accounts"]) > 0)
                                          {
                                              foreach($details["accounts"] as $account)
                                              {
                                                   ?>
                                                   <li>
                                                        <?= $account->user_name; ?> <span class="expires"><?= $this->lang->line('mu39'); ?> <strong><?= (trim($account->expires) == '')?$this->lang->line('mu40'):substr($account->expires, 0, 19); ?></strong></span>
                                                        <div class="btn-group pull-right">
														<?php if($net["network_name"]=='google_mybusiness')
						                                     {?>
                                                            <button type="button" class="btn btn-default mybusiness_select_net" <?php if($details["network"]->categories): echo 'data-categories="1"'; endif; ?> data-account="<?= $account->network_id; ?>" data-net="<?= $account->net_id; ?>">
                                                                <?= $this->lang->line('mu42'); ?>
                                                            </button>
															<?php } else{ ?>
															<button type="button" class="btn btn-default select-net" <?php if($details["network"]->categories): echo 'data-categories="1"'; endif; ?> data-account="<?= $account->network_id; ?>" data-net="<?= $account->net_id; ?>">
                                                                <?= $this->lang->line('mu42'); ?>
                                                            </button>
															<?php } ?>
                                                        </div>
                                                   </li>
                                                   <?php
                                              }
                                          }
                                          ?>
                                       </ul>
                                   </div>
                               </div>
                            </li>
                            <?php
							if(!isset($user_options["disable_preview"]))
							{
								?>
                                    <li class="show-preview">
                                       
                                    </li>                              
								<?php
							}
                            if ($net["network_name"] == "blogger") {
                                $categories[] = ["network" => $net["network_name"], "blog_id" => $net["net_id"]];
                            }
                            if ($net["network_name"] == "wordpress") {
                                $categories[] = ["network" => $net["network_name"], "blog_id" => $net["net_id"]];
                            }
                        }
                    }
					?>
					 <li class="netsel" data-network="website_post">
                                <span class="icon pull-left" style="background-color:"><img src="assets/img/browser2.png"></span> <span class="netaccount pull-left">Website Post</span>
                                <div class="btn-group pull-right">
                                    <button type="button" data-type="main" class="btn btn-default web_post">
                                        <?= $this->lang->line('mu42'); ?>
                                    </button>
                                    <button type="button" class="btn btn-default show-accounts">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
					<?php
					echo '</ul>';
                }
                else
                {
                    echo '<ul style="padding:10px">';?>
					 <li class="netsel" data-network="website_post">
                                <span class="icon pull-left" style="background-color:"><img src="assets/img/browser2.png"></span> <span class="netaccount pull-left">Website Post</span>
                                <div class="btn-group pull-right">
                                    <button type="button" data-type="main" class="btn btn-default web_post">
                                        <?= $this->lang->line('mu42'); ?>
                                    </button>
                                    <button type="button" class="btn btn-default show-accounts">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
				<?php echo '</ul>';	
                }
                ?>              
            </div>
			<?php
			}
			?>
			<div class="website_iframe_url" style="display:none">
			<input type="url" placeholder="Enter Your Website Url" id="web_url_input">
			<button id="show_iframe">Show Iframe</button>
			</div>
			<?php
			if(isset($options['tool_posts-planner']) && get_user_option('display_planner_form')){
			?>
            <div class="col-lg-12 widget planner">
                <div class="row">
                    <div class="panel-heading">
					    <i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->lang->line('mu190') ?>
						<div class="btn-group pull-right"><button type="button" data-type="main" class="btn btn-default add-repeat"><?= $this->lang->line('mu189') ?></button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 post-plans">
					    <div class="list-group">
						    <p><?= $this->lang->line('mu192') ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
            </div>
			<?php
			}
			?>
            <?php if($published >= $limit): ?>
			    <div class="col-lg-12">
                    <div class="show-upgrade-purpose"><?= display_mess(97); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
				</div>
            <?php endif; ?>
			<?php if ( !get_option( 'enable-old-scheduling' ) ) : ?>
			<div class="calendar-widget" data-format="1">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="midrub-caledar">
                            <thead>
                                <tr>
                                    <th class="text-center"><a href="#" class="go-back"><span class="fa fa-arrow-left"></span></a></th>
                                    <th colspan="5" class="text-center year-month"></th>
                                    <th class="text-center"><a href="#" class="go-next"><span class="fa fa-arrow-right"></span></a></th>
                                </tr>
                            </thead>
                            <tbody class="calendar-dates">
                            </tbody> 
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <input class="form-control" id="filter-hours" type="text" placeholder="Search..">
                        <ul class="list-group" id="time-format">
                        </ul>
                    </div>
                </div>
			</div>
			<?php endif; ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 buttons">
                        <?php 
						if (isset($options["enable-scheduled"])): ?>
                            <a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <?= $this->lang->line('mu346'); ?></a>
                            <input type="text" class="datetime" />
                        <?php endif; ?>
                        <button type="submit" class="btn btn-success pull-right"> <?= $this->lang->line('mu43'); ?></button>
                        <?php if (isset($options["enable-draft-messages"])): ?>
                            <button type="submit" class="btn btn-default pull-right draft-save"><?= $this->lang->line('mu44'); ?></button>
                        <?php endif; ?>
                        <img src="<?= base_url(); ?>assets/img/load-prev.gif" class="pull-right loadsend">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right all-posts">
            <div class="col-lg-12 post-scroll">
                <div class="row">
                    <div class="panel-heading">
                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $this->lang->line('mu2'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mess-stat">
                        <div class="input-group search">
                            <input type="text" placeholder="<?= $this->lang->line('mu49'); ?>" class="form-control search_post">
                            <span class="input-group-btn search-m">
                                <button class="btn" type="button"><i class="fa fa-binoculars"></i><i class="fa fa-times" aria-hidden="true"></i></button>
                            </span> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mess-stat">
                        <ul>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination">
                        </ul>
                        <img src="<?= base_url(); ?>assets/img/pageload.gif" class="pull-right pageload"> </div>
                </div>
            </div>
			
        </div>
		<div class="website_iframe" style="display:none">
		<iframe class="frame1 web_post_iframe" src="" id="post_iframe"></iframe>
		</div>
		<div class="mybusiness_iframe" style="display:none; clear: both;" id="mybusiness_div">
		 <div class="wrap" id="google_div">
                 <?php   include('mybisiness_location.php');  ?>

                  </div>
		</div>
		
    </div>
</div>
</div>
<?= form_close() ?>
</section>
<div class="modal fade" id="secat" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu45'); ?></h4>
            </div>
            <div class="modal-body">
                <select class="form-control" id="selnet">
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default categories-select" data-dismiss="modal"><?= $this->lang->line('mu46'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="crop-img" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $this->lang->line('mu47'); ?></h4>
            </div>
            <div class="modal-body show-image">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default crop-the-im" data-dismiss="modal"><?= $this->lang->line('mu48'); ?></button>
            </div>
        </div>
    </div>
</div>
 <div id="localpostModel" class="modal" >
                                            <div class="modal-inner-pop">
                                            	<div class="post-pop-bg-div">
                                              
											
	   <div class="post-popup-area">
				<ul class="create-post-ul">
					<li><a href="javascript:void(0)" onclick="cancel_btn();" ><i class="fa fa-times" aria-hidden="true"></i></a></li>
					<li class="create">Create post</li>
					
				
				</ul>
				<div class="post-pop-tab">
					 <ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item" id="changes_on_whts_tab" onclick="show_localPost_Fields(1);">
						<a class="nav-link active" id="whts-new-tab" data-toggle="tab" href="#whts-new" role="tab" aria-controls="whts-new" aria-selected="true"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Whats's New</a>
					  </li>
					  <li class="nav-item" id="changes_on_events_tab" onclick="show_localPost_Fields(2);">
						<a class="nav-link" id="events_pop-tab" data-toggle="tab" href="#events_pop" role="tab" aria-controls="events_pop" aria-selected="false"><i class="fa fa-calendar" aria-hidden="true"></i>Events</a>
					  </li>
					  <li class="nav-item" id="changes_on_offer_tab" onclick="show_localPost_Fields(3);">
						<a class="nav-link" id="Offers_pop-tab" data-toggle="tab" href="#Offers_pop" role="tab" aria-controls="Offers_pop" aria-selected="false"><i class="fa fa-tag" aria-hidden="true"></i>Offers</a>
					  </li>
					  <!--li class="nav-item">
						<a class="nav-link" id="products_pop-tab" data-toggle="tab" href="#products_pop" role="tab" aria-controls="products_pop" aria-selected="false"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Products</a>
					  </li-->
					</ul>
					<div class="tab-content" id="myTabContent">
					 <form  method="post" id="mybusiness_post_form" enctype="multipart/form-data" >
					 <div class="tab-pane fade show active" id="whts-new" role="tabpanel" aria-labelledby="all-tab">
                     <input type="hidden"  name="loc_name" value="" id="mybusiness_loc_name" />
						 <input type="hidden"  name="TopicType" id="localpost_topictype" value="STANDARD" />
		  <div class="whsts-pop-cont">
							<div class="need-idea">
							
								<a href="#"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><span>Need some ideas?</span> Look at some sample posts.</a>
							</div>
							<div class="newd-idea-img-pop text-center upload-section">
							<input type="file" name="post_img" class="upload-img" accept="image/*"/>
								<a href="#">
									<span><i class="fa fa-camera" aria-hidden="true"></i></span>
									<h6>Make your post stand out with a photo or video</h6>
								</a>
							</div>
							<div class="preview-section"></div>
							<div class="write-post-popup" id="localpost_detail">
								<div class="form-group">
									<input type="text" placeholder="Write Your Post"  name="post_detail" id="post_detail_localpost" class="form-control">
									<span><i class="fa fa-info-circle" aria-hidden="true"></i></span>
								</div>
								<p>100 - 300 words</p>
							</div>
							<div class="write-post-popup sale-input" id="localpost_title" style="display:none">
								<div class="form-group">
									<input type="text" placeholder="Event Title" name="event_title" id="post_title_localpost" class="form-control">
									 </div>
								<p id="post_text_localpost">(Example: Promotions this week)</p>
							</div>
							
							<div class="date-time-post" id="post_date_time_locahost" style="display:none">
								<ul>
									<li><input type="text" name="start_date" placeholder="Start Date"  class="form-control  datepicker">
									</li>
									<li><input type="text" placeholder="Start Time"  name="start_time" class="form-control timepicker">
									</li>
									<li><input type="text" placeholder="End Date"  name="end_date" class="form-control datepicker">
									</li>
									<li><input type="text" placeholder="End Time"  name="end_time" class="form-control timepicker">
									</li>
								</ul>
							</div>
							
							<div class="whtas-select" id="localpost_calltoaction">
								<select  name="callToAction">
								<option class="addto-btn">Add a button (optional) <span class="caret"></span></option>
								<option value="BOOK">Book</option>
								<option value="ORDER">Order Online</option>
								<option value="SHOP">Buy</option>
								<option value="LEARN_MORE">Learn More</option>
								<option value="SIGN_UP">Sign Up</option>
								<option value="GET_OFFER">Get Offer</option>
								<option value="CALL">Call Now</option>
								 </select>
							</div>
							<div class="write-post-popup" id="localpost_post_url">
								<div class="form-group">
									<input type="text" placeholder="Link for your button"  name="post_url" class="form-control">
								
								</div>
								
							</div>
							<div class="write-post-popup sale-input" id="localpost_coupon_code" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Coupon code (optional)"  name="couponCode" class="form-control">
								</div>
							</div>
								<div class="write-post-popup sale-input" id="localpost_offer_link" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Link to redeem offer (optional)"  name="redeemOnlineUrl" class="form-control">
								</div>
							</div>
								<div class="write-post-popup sale-input" id="localpost_offer_term_condition" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Terms and conditions (optional)" name="termsConditions" class="form-control">
								</div>
							</div>
							
							
							
						  </div>
						  <div class="form_submit_button">
                          <input type="submit" value="Publish" name="submit_form"  >
                       </div>						  
                       </div>						  
					 </form>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
<!--upload image form !-->
<?php
$attributes = array('class' => 'upim', 'id' => 'upim', 'method' => 'post');
echo form_open_multipart('user/posts', $attributes);
?>
<input type="hidden" name="type" id="type">
<input type="file" name="file" id="file" accept=".gif,.jpg,.jpeg,.png<?php if (isset($options["enable-video-uplodad"])): ?>,.mp4,.avi<?php endif; ?>">
<?php
echo form_close();
?>
