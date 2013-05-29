<?php

use Equity\Library\Text;

$errors = $this['errors'] ?>

<div id="project-steps">
            
            <fieldset>

                <legend><h3><?php echo Text::get('form-navigation_bar-header'); ?></h3></legend>

                <div class="steps">
                    
                    
                    <!--<span class="step first-off off<?php if ($this['step'] === 'userProfile') echo ' active'; else echo ' activable'; ?>">
                        <button type="submit" name="view-step-userProfile" value="<?php echo Text::get('step-1'); ?>"><?php echo Text::get('step-1'); ?>
                        <strong class="number">1</strong></button>                        
                    </span>-->
                    
                    <fieldset style="display: inline">
                    
                        <legend>Apllication for pitch<!--<?php echo Text::get('regular-new_project'); ?>--></legend>
                     
                        
                        <span class="step <?php if ($this['step'] === 'userPersonal') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-userPersonal" value="<?php echo Text::get('step-1'); ?>"><?php echo Text::get('step-1'); ?>
                            <strong class="number">1</strong></button>
                        </span>
                        
                        <span class="step <?php if ($this['step'] === 'enterprise') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-enterprise" value="You company">Your company
                            <strong class="number">2</strong></button>
                        </span>
                        
                        
                    </fieldset>
                    
                    
                    <!--<span class="step <?php if ($this['step'] === 'userPersonal2') echo ' active'; else echo ' activable'; ?>">
                        <button type="submit" name="view-step-userPersonal2" value="meu">Meu
                        <strong class="number">1</strong></button>
                    </span>-->
                    
                    <span class="step <?php if ($this['step'] === 'pitch') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-pitch" value="Pitch">Pitch
                            <strong class="number">3</strong></button>
                    </span>
                    
                    <span class="step <?php if ($this['step'] === 'entrepreneurs') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-entrepreneurs" value="Entrepreneurs">Entrepreneurs
                            <strong class="number">4</strong></button>
                    </span>
                    
                    <span class="step on-off <?php if ($this['step'] === 'rewards') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-rewards" value="<?php echo Text::get('step-5'); ?>">Rewards<!--<?php echo Text::get('step-5'); ?>-->
                            <strong class="number">5</strong></button>                            
                    </span>
                    
                    
                    <fieldset style="display: inline">
                        
                        <legend><?php echo Text::get('regular-new_project'); ?></legend>
                        
                        <span class="step off-on<?php if ($this['step'] === 'company') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-company" value="<?php echo Text::get('step-2'); ?>"><?php echo Text::get('step-2'); ?>
                            <strong class="number">2</strong></button>                            
                        </span>

                        <!--<span class="step on-on<?php if ($this['step'] === 'costs') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-costs" value="<?php echo Text::get('step-3'); ?>"><?php echo Text::get('step-4'); ?>
                            <strong class="number">3</strong></button>                            
                        </span>-->

                        

 					</fieldset>
						
                        <span class="step off-off<?php if ($this['step'] === 'supports') echo ' active'; else echo ' activable'; ?>">
                            <button type="submit" name="view-step-supports" value="<?php echo Text::get('step-6'); ?>"><?php echo Text::get('step-6'); ?>
                            <strong class="number">5</strong></button>                            
                        </span>
                        
                        
                   
                    
                    
                    
                    <span class="step off-last off<?php if ($this['step'] === 'preview') echo ' active'; else echo ' activable'; ?>">
                        <button type="submit" name="view-step-preview" value="<?php echo Text::get('step-7'); ?>"><?php echo Text::get('step-7'); ?>
                        <strong class="number">5</strong></button>                        
                    </span>

                </div>

            </fieldset>
        </div>