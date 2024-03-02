<h1 style="text-align:center;">Science Scholar Awards - <?=date("Y");?></h1>
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
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['citizenship']) && ($nomineeData['citizenship']==1))?'Indian':'Other';?></td>
                  </tr>
                  <tr>
                     <td width="200" border="1">Ongoing Course</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['ongoing_course']))?$nomineeData['ongoing_course']:'';?></td>
                  </tr>
                  <?php if(!empty($nomineeData['course_name'])){?>
                  <tr>
                     <td width="200" border="1">Course Name</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['course_name']) )?$nomineeData['course_name']:'';?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td width="200" border="1"> Whether the applicant has completed a Research Project</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['is_completed_a_research_project']))?$nomineeData['is_completed_a_research_project']:'';?></td>
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
                  <tr>
                     <td width="200" border="1">Number of Attempts</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['number_of_attempts']) && ($nomineeData['number_of_attempts']))?$nomineeData['number_of_attempts']:'';?></td>
                  </tr>

                  <tr>
                     <td width="200" border="1">Year of Passing</td>
                     <td border="1" style="color: #047CB2"><?=(isset($nomineeData['year_of_passing']) && ($nomineeData['year_of_passing']))?$nomineeData['year_of_passing']:'';?></td>
                  </tr>
               </table>
         </tr>
         </td>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Letter from the supervisor certifying that the research work submitted for Sun Pharma Science Scholar Award has actually been done by the applicant </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['supervisor_certifying'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Justification for Sponsoring the Nomination duly signed by the Nominator/Supervisor </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['justification_letter_filename'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Complete Bio-data of the Applicant </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['complete_bio_data'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Details of the excellence in research work for which the Sun Pharma Science Scholar Award is claimed, including references and illustrations with following headings- Title, Introduction, Objectives, Materials and Methods, Results, Statistical Analysis, Discussion, Impact of the research in the advancement of knowledge or benefit to mankind, Literature reference. The candidate should duly sign on the details</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['excellence_research_work'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">List of Publications, if any. If yes, Upload copies of any two publications</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['lists_of_publications'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Statement of Merits/Awards/Scholarships already received by the Applicant</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['statement_of_applicant'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">A letter stating that the project submitted for the award has received “ethical clearance” </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                       <?=$nomineeData['ethical_clearance'];?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">A statement duly signed by the nominee and the supervisor/co-author that academically or financially the thesis submitted for Sun Pharma Science Scholar Award-<?=date("Y");?> has “non-conflict of interest” with the supervisor or co-authors </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['statement_of_duly_signed_by_nominee']?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
        
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Citation (brief summary) on the Research Work of the Applicant duly signed by the Nominator  </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['citation']?>
                      
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Aggregate marks obtained in PCB/PCM in Class XII or any other course</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['aggregate_marks']?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Age Proof</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['age_proof']?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">A voluntary declaration from the candidate that they would work in the public or private funded academic/research based organizations for a minimum period of two years after completion of his/her studies. </td>
                  </tr>
                  <tr>
                     <td border="1" style="padding:10px;">
                     <?=$nomineeData['declaration_candidate']?>
                       
                    </td>
                  </tr>
               </table>
            </td>
         </tr>
         
      </table>