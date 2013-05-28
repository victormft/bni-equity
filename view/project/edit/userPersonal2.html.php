<form action="<?php echo SITE_URL ?>cliente/create" method="post" name="about_you">

	<h3>Informações sobre o líder da empresa</h3>

	<div class="hint">                    
        <blockquote><strong>The only thing left is to fill in your data if you want your project to be co-financed and supported through Goteo.</strong><br><br>The information in this section is necessary so that we can contact you if you get the required financing, and be able to make the deposit. In the case of organizations, we recommend that the representative of the organization be formally accredited (for example, by way of the statutes or a certificate of the secretary with an OK from the president, in the case of associations).</blockquote>
    </div>

    
	<div class="elements">
    
    	<h4>Informações pessoais</h4>
    
        <li>
            <h5 class="title">Nome completo</h5>
            <input class="input_text" name="leader_name" type="text" />                      
        </li>
      
        <li>
            <h5 class="title">Gênero</h5>
            <select name="leader_gender">
                <option value="m">Masculino</option> 
                <option value="f">Feminino</option>
            </select>                      
        </li>

    	<li>
            <h5 class="title">Data de nascimento</h5>
            
           
            Dia
            <select name="dia">
            <?php for($i=1; $i<=31; $i++) {?>
            
            <option value="<?php echo $i; ?>"><?php if($i<10) echo"0".$i; else echo $i; ?></option>    
            <?php }?>
            
            </select>
            
            
            Mês
            <select name="mes">
            <option value="1">Janeiro</option> 
            <option value="2">Fevereiro</option> 
            <option value="3">Março</option> 
            <option value="4">Abril</option> 
            <option value="5">Maio</option> 
            <option value="6">Junho</option> 
            <option value="7">Julho</option> 
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>   
            <option value="12">Dezembro</option>
            </select>
            
            Ano
            <select name="ano">
            <?php for($i=1930; $i<=2013; $i++) {?>
            
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>    
            <?php }?>
            
            </select>
   
                              
        </li>
        
        
        
        <h4>Contato</h4>
    
   		<li>
            <h5 class="title">Telefone</h5>
            <input class="input_text" name="leader_telephone" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Email</h5>
            <input class="input_text" name="leader_email" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Perfil no Facebook (URL)</h5>
            <input class="input_text" name="leader_facebook" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Perfil no LinkedIn (URL)</h5>
            <input class="input_text" name="leader_linkedin" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Perfil no Twitter (URL)</h5>
            <input class="input_text" name="leader_twitter" type="text" />                       
        </li>
        
        <h4>Endereço</h4>
        
        <li>
            <h5 class="title">Rua</h5>
            <input class="input_text" name="leader_street" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Cidade</h5>
            <input class="input_text" name="leader_city" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">Estado</h5>
            <input class="input_text" name="leader_estate" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">CEP</h5>
            <input class="input_text" name="leader_cep" type="text" />                       
        </li>
        
        <li>
            <h5 class="title">País</h5>
            <input class="input_text" name="leader_country" type="text" />                       
        </li>
        
        <input name="submit" type="submit" value="Cadastrar" class="button_submit" />
        
        <input name="reset" type="reset" value="Reset" class="button_reset" />
    
    </div>

</form>


