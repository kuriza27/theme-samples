<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: Please add the following <META> element to your page <HEAD>.      -->
<!--  If necessary, please modify the charset parameter to specify the        -->
<!--  character set of your HTML page.                                        -->
<!--  ----------------------------------------------------------------------  -->
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
    <!--  ----------------------------------------------------------------------  -->
    <!--  NOTE: Please add the following <FORM> element to your page.             -->
    <!--  ----------------------------------------------------------------------  -->
<div class="mobile-space">
    <form action="https://webto.salesforce.com/servlet/servlet.WebToCase?encoding=UTF-8" method="POST" class="web-to-case-form">
        <input type=hidden name="orgid" value="00D7F000005UBRb">
        <input type=hidden name="retURL" value="<?php echo site_url() . '/about/contact-us/confirmation/'; ?>">
        <!--  ----------------------------------------------------------------------  -->
        <!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
        <!--  these lines if you wish to test in debug mode.                          -->
        <!--  <input type="hidden" name="debug" value=1>                              -->
        <!--  <input type="hidden" name="debugEmail"                                  -->
        <!--  value="admin@smartapps.com.au">                                         -->
        <!--  ----------------------------------------------------------------------  -->
        <div class="row contact-frm-salesforce">
            <div class="col">
                <label for="firstName">First Name:<span class="text-required">*</span></label>
                <input id="firstName" name="00N7F00000SeTUs" maxlength="40" size="20" type="text" class="required-input-field" placeholder="Enter your first name"/>
            </div>
            <div class="col">
                <label for="lastName">Last Name:<span class="text-required">*</span></label>
                <input id="lastName" name="00N7F00000SeTUt" maxlength="80" size="20" type="text" class="required-input-field" placeholder="Enter your last name" />
            </div>
        </div>

        <div class="row contact-frm-salesforce mt-4">
            <div class="col">
                <label for="email">Email:<span class="text-required">*</span></label>
                <input id="email" maxlength="80" name="email" size="20" type="email" class="required-input-field" placeholder="Enter your email"/>
            </div>
            <div class="col">
                <label for="phone">Phone:<span class="text-required">*</span></label>
                <input id="phone" maxlength="40" name="phone" size="20" type="tel" class="required-input-field" placeholder="Enter your phone number"/>
            </div>
        </div>

        <div class="row contact-frm-salesforce mt-4">
            <div class="col">
                <label for="reason">I would like to enquire about:<span class="text-required">*</span></label>
                <select id="reason" name="reason" class="required-input-field" onChange="buildSubReasonOptions($(event.target).val()); return false;">
                    <option value="" >--None--</option>
                    <option value="Advice or information about investment opportunities">Advice or information about investment opportunities</option>
                    <option value="General enquiry about the Australia Council">General enquiry about the Australia Council</option>
                    <option value="Reports or activity on arts research or industry analysis">Reports or activity on arts research or industry analysis</option>
                    <option value="Media Enquiries">Media Enquiries</option>
                    <option value="Events">Events</option>
                </select>
            </div>
        </div>
        
        <div class="row contact-frm-salesforce sub-reason mt-4 d-none">            
            <div class="col">
                <label for="subReason">Select a topic:<span class="text-required">*</span></label>
                <select id="subReason" name="00N7F00000QW8hg" title="Case Sub Reason">
                    <option value="" >--None--</option>
                    <option value="Australia Council investment opportunities and programs">Australia Council investment opportunities and programs</option>
                    <option value="Potential research collaborations">Potential research collaborations</option>
                    <option value="Current Australia Council research publications and reports (last 3 years)">Current Australia Council research publications and reports (last 3 years)</option>
                    <option value="Historical Australia Council research publications and reports">Historical Australia Council research publications and reports</option>
                    <option value="International Opportunities">International Opportunities</option>
                    <option value="Capacity Building and Leadership Programs">Capacity Building and Leadership Programs</option>
                    <option value="First Nations Arts and Culture">First Nations Arts and Culture</option>
                <option value="First Nations Arts Awards"> First Nations Arts Awards</option>
                    <option value="Co-investment opportunities">Co-investment opportunities</option>
                    <option value="Marketing Summit">Marketing Summit</option>
                    <option value="Australia Council Awards">Australia Council Awards</option>
                    <option value="National Arts and Disability Awards">National Arts and Disability Awards</option>
                <option value="Other opportunities">Other opportunities</option>
                    <option value=" Other Australia Council events"> Other Australia Council events</option>
                </select>
             </div>            
        </div>
        <div class="contact-frm-salesforce mt-4">
            <label for="description">Message:<span class="text-required">*</span></label>
            <textarea name="description" class="required-input-field"></textarea>
        </div>
        <div class="contact-frm-salesforce-btn mt-4">
            <input type="submit" class="btn btn--dark" name="submit" value="Send Message" onClick="return validateFields();">
        </div>
    </form>
</div>