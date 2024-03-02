<h1 style="text-align:center;">Research Awards - <?=date("Y");?></h1>
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
                     <td colspan="1"  border="1"  style="padding:10px;">In order of Importance, list of 10 best papers of the applicant highlighting the important discoveries/contributions described in them briefly </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['best_papers'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Statement of Research Achievements, if any, on which any Award has already been Received by the Applicant. Please also upload  brief citations on the research works for which the applicant has already received the awards </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['statement_of_research_achievements'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Signed details of the excellence in research work for which the Sun Pharma Research Award is claimed, including references & illustra- tions (Max. 2.5 MB). The candidate should duly sign on the details</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                        <?=$nomineeData['signed_details'];?>
                          
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Two specific publications/research papers of the applicant relevant to the research work mentioned above</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                       <?=$nomineeData['specific_publications'];?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">A signed statement by the applicant that the research work under reference has not been given any award. The applicant should also indicate the extent of the contribution of others associated with the research and he/she should clearly acknowledge his/her achievements.</td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['signed_statement']?>
                        
                    </td>
                  </tr>
               </table>
                </td>
         </tr>
        
         <tr>
            <td>
               <table width="100%" style="border: 1px solid #ddd; background: #fdfdfd; ">
                  <tr>
                     <td colspan="1"  border="1"  style="padding:10px;">Citation on the Research Work of the Applicant duly signed by the Nominator  </td>
                  </tr>
                  <tr>
                     <td style="padding:10px;"  border="1" >
                     <?=$nomineeData['citation']?>
                      
                    </td>
                  </tr>
               </table>
                </td>
         </tr>

         
         
      </table>