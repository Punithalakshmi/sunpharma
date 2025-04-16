<h1 style="text-align:center;">Clinical Research Fellowship - <?=date("Y");?></h1>
<table class="nominee-section"  style="width:100%; margin-right:auto; margin-left: auto; border: 0; color: #000; font-size: 16px; font-family: Arial, Helvetica, sans-serif; ">
         <tr>
            <td>
               <table>
                  <tr>
                     <td width="200" border="1">Nomination NO </td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['registration_no']) && ($nomineeData['registration_no']))?$nomineeData['registration_no']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Award</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['award']) && ($nomineeData['award']))?$nomineeData['award']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Award Type</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['category_name']) && ($nomineeData['category_name']))?$nomineeData['category_name']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Name</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['firstname']) && ($nomineeData['firstname']))?$nomineeData['firstname'].' '.$nomineeData['lastname']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Date of Birth</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['dob']) && ($nomineeData['dob']))?$nomineeData['dob']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Email</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['email']) && ($nomineeData['email']))?$nomineeData['email']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Mobile No</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['phone']) && ($nomineeData['phone']))?$nomineeData['phone']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Designation & Office Address</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['address']) && ($nomineeData['address']))?$nomineeData['address']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Residence Address</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['residence_address']) && ($nomineeData['residence_address']))?$nomineeData['residence_address']:'';?></td>
                  </tr>
                 
                  <tr>
                     <td width="200" border="1">Citizenship</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['citizenship']) && ($nomineeData['citizenship']==1))?'Indian':'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Name of the Nominator</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['nominator_name']) && ($nomineeData['nominator_name']))?$nomineeData['nominator_name']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Nominator Email</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['nominator_email']) && ($nomineeData['nominator_email']))?$nomineeData['nominator_email']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Nominator Phone</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['nominator_phone']) && ($nomineeData['nominator_phone']))?$nomineeData['nominator_phone']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Nominator Designation</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['nominator_designation']) && ($nomineeData['nominator_designation']))?$nomineeData['nominator_designation']:'';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Nominator Address</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['nominator_address']) && ($nomineeData['nominator_address']))?$nomineeData['nominator_address']:'';?></td>
                  </tr>
               </table>
         </tr>
         </td>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Justification for Sponsoring the Nomination duly signed by the Nominator (not to exceed 400 words)</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['justification_letter_filename'];?>
                          <!-- <a style="color:#F7941E; text-decoration: none;"  href="">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Complete Bio-data of the Applicant (Max: 1.5 MB)</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                       <?=$nomineeData['complete_bio_data'];?>
                        <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%">
                  <tr>
                     <td colspan="2" bgcolor="#f7f7f7"  border="1" style="padding:10px;">First Employment:</td>
                  </tr>
 <tr>
                     <td colspan="2"  border="1" style="padding:10px;"> </td>
                  </tr>
                  <tr>
                     <td border="1" style="padding-bottom:8px;">Name of institution and location</td>
                     <td border="1" style="padding-bottom: 8px;">Year of joining:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;" ><?=$nomineeData['first_employment_name_of_institution_location']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['first_employment_year_of_joining']?></td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom: 8px;">Designation/post</td>
                     <!-- <td border="1" style="padding-bottom: 8px;">Year of award of degree:</td> -->
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['first_employment_designation']?></td>
                     <!-- <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;">sdfsdf</td> -->
                  </tr>
               </table>
                  </td>
         </tr>
      
        
         <tr>
            <td>
               <table width="100%">
                 
			<tr>
                     <td colspan="2" bgcolor="#f7f7f7"  border="1" style="padding:10px;">First medical degree obtained: </td>
                  </tr>
	 <tr>
                     <td colspan="2"  border="1" style="padding:10px;"> </td>
                  </tr>

                  <tr>
                     <td  border="1" style="padding-bottom:8px;">Name of degree:</td>
                     <td border="1" style="padding-bottom: 8px;">Year of award of degree:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;" ><?=$nomineeData['first_medical_degree_name_of_degree']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['first_medical_degree_year_of_award']?></td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom: 8px;">Institution awarding the degree:</td>
                     <td border="1" style="padding-bottom: 8px;">Marksheet:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['first_medical_degree_institution']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['first_degree_marksheet']?></td>
                  </tr>
               </table>
                  </td>
         </tr>


         <tr>
            <td>
               <table width="100%">
                  <tr>
                     <td colspan="2" bgcolor="#f7f7f7"  border="1" style="padding:10px;">Highest medical degree obtained:</td>
                  </tr>
 <tr>
                     <td colspan="2"  border="1" style="padding:10px;"> </td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom:8px;">Name of degree:</td>
                     <td border="1" style="padding-bottom: 8px;">Year of award of degree:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;" ><?=$nomineeData['highest_medical_degree_name']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['highest_medical_degree_year']?></td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom: 8px;">Institution awarding the degree:</td>
                     <td border="1" style="padding-bottom: 8px;">Marksheet:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['highest_medical_degree_institution']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;padding-bottom:8px;"><?=$nomineeData['highest_degree_marksheet']?></td>
                  </tr>
               </table>
                  </td>
         </tr>


          



         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Research Experience (including, summer research, hands-on research workshop, etc.) </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['fellowship_research_experience']?>
                         <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
        
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Research publications, if any, with complete details (title, journal name, volume number, pages, year, and/or other relevant information) </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['fellowship_research_publications']?>
                         <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Awards and Recognitions (such as, Young Scientist Award of a science or a medical academy or a national association of the applicant’s specialty)</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['fellowship_research_awards_and_recognitions']?>
                         <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Name of the institution in which research work on the Sun Pharma Science Foundation Clinical Research Fellowship will be carried out, if awarded:</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['fellowship_name_of_institution_research_work']?>
                         <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%">
                  <tr>
                     <td colspan="2" bgcolor="#f7f7f7"  border="1" style="padding:10px;">If awarded, supervisor under whom research work on the Sun Pharma Science Foundation Clinical Research Fellowship will be carried out: (a) Name of supervisor, (b) Institution, (c) Department:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom:8px;">Name of supervisor:</td>
                     <td border="1" style="padding-bottom: 8px;">Institution:</td>
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0" ><?=$nomineeData['fellowship_name_of_the_supervisor']?></td>
                     <td border="1" style="color: #047CB2; padding-top:0;"><?=$nomineeData['fellowship_name_of_institution']?></td>
                  </tr>
                  <tr>
                     <td  border="1" style="padding-bottom: 8px;">Department:</td>
                     <!-- <td border="1" style="padding-bottom: 8px;">Marksheet:</td> -->
                  </tr>
                  <tr>
                     <td  border="1" style="color: #047CB2; padding-top:0;"><?=$nomineeData['fellowship_supervisor_department']?></td>
                     <!-- <td border="1" style="color: #047CB2; padding-top:0;"><?//$nomineeData['highest_degree_marksheet']?></td> -->
                  </tr>
               </table>
                  </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Description of research to be carried out if the Sun Pharma Science Foundation Clinical Research Fellowship is awarded (2 pages), comprising the following sections: (a) Introduction, (b) Objectives, (c) Brief description of pilot data, if available, (d) Methodology, (e) Anticipated outcomes, (f) Timelines</td>
                  </tr>
                  <tr>
                     <td border="1" style="padding:10px;">
                     <?=$nomineeData['fellowship_description_of_research']?>
                         <!-- <a style="color:#F7941E; text-decoration: none;"  href="Resources/path.pdf">sample-sm_11.pdf </a> -->
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         

      </table>