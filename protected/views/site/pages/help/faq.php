<?php $this->beginWidget('CMarkdown');?>

## <a id="index"></a>Frequently Asked Questions ##

1. [What can St. Bennos do?](#features)
1. [How do I create a family?](#family-create)
1. [How do I edit a family?](#family-edit)
1. [How do I capture family survey details?](#family-survey)
1. [How do I add more than 2 dependents to a family?](#family-more-deps)
1. [How do I add more than 3 children to a family?](#family-more-children)
1. [How do I add a photo for a family?](#family-photo)
1. [How do I add a photo for a person?](#member-photo)
1. [How do I add a Google map for a family?](#google-map)
1. [What kind of registers are available?](#register-types)
1. [How do I create an entry in a register?](#registers)
1. [What kind of certificates are available?](#certificate-types)
1. [How do I create a sacramental certificate (baptism / first communion / confirmation / marriage)?](#certificates)

## FAQ - Answers ##

1. <a id="features"></a>What can St. Bennos do?

	St. Benno's Parish Software can help you:

	 * Create, Edit and View families
	 * Add members to families, edit, view members
	 * Survey family members - satisfation, needs, generic Q/A
	 * Set photos for families, members
	 * Add entries to parish registers - baptism, first communion, confirmation, banns, marriage, death
	 * Generate certificates for baptism, first communion, confirmation, marriage, death
	 * Generate banns letters, mass booking receipts
	 * Custom member search with export to excel, e.g children (age<15), youth (age 15-30), doctors, etc

  &nbsp;

  [Top](#index)

1. <a id="family-create"></a>How do I create a family?

	To create a family, click the View Families link under Home.
	Next, click the "Create Family" link in the right sidebar.
	Fill the form tab by tab, first fill the family details tab.
	Next, fill the husband and wife tabs. At least one of these is required.
	Next, fill the dependents tabs.
	Next, fill the children tabs.
	Any of these dependents, children tabs can be skipped.

  [Top](#index)

1. <a id="family-edit"></a>How do I edit a family?

	Click the "View Families" link under Home.
	Next, click the link (id) of the family you want to edit.
	Next, click the "Update Family" link.
	Edit the fields you want, and click "Save".

  [Top](#index)

1. <a id="family-survey"></a>How do I capture family survey details?

  Click the "View Families" link under Home to get a family listing.
	Click the link (id) of the family you want to survey.
	In the right sidebar, click the "Survey Family" link.
	Fill each of the 4 tabs of the survey: satisfaction, needs, awareness and open questions, click "Save".

  [Top](#index)

1. <a id="family-more-deps"></a>How do I add more than 2 dependents to a family?

	Similar to adding more childern- add 2 dependents using the create/update family.
	Now, view the family by clicking "View Family".
	There now appears a link "More Dependents" in the right sidebar - click it.
	Add the extra children in the form providid and save.

  [Top](#index)

1. <a id="family-more-children"></a>How do I add more than 3 children to a family?

	First, add 3 children using the create/edit family function.
	Now, view the family by clicking "View Family".
	There now appears a link "More Children" in the right sidebar - click it.
	Add the extra children in the form provided and save.

  [Top](#index)

1. <a id="family-photo"></a>How do I add a photo for a family?

  Go to "Home" and click "View Families".
	Then click the link (id) of the family you want to add the photo to.
	Next, click the "Upload Photo" link. Browse your system for the photo and click "Save".
	Next, select a region of the photo and click "Crop".
	The cropped photo is now set for the family.

  [Top](#index)

1. <a id="member-photo"></a>How do I add a photo for a person?

	Go to "Home" and click "Total n members" to view member list.
	Click the link (id) of the member you want to add the photo for.
	Click the "Upload Photo" link.
	Select a photo from your system and click "Save".
	Select a region of the photo and click "Crop".
	The cropped photo is now set for the person.

	**P.S:** The member can also be selected through member search

  [Top](#index)

1. <a id="google-map"></a>How do I add a Google map for a family?

  Go to "Home" and click "View Families" to view the family list.
	Click the link (id) of the family you want to add the Google map for.
	Click the "Locate on Google maps" link.
	In another tab, open [Google maps](http://maps.google.com) and locate the address.
	Click the Share link (anchor) and copy the URL.
	Paste the URL in the St. Benno's textarea and click "Save".

  [Top](#index)

1. <a id="register-types"></a>What kind of registers are available?

	Registers are available for the sacraments, death and banns:

	  1. Marriage register
	  1. Baptism register
	  1. First Communion register
	  1. Confirmation register
	  1. Death register
	  1. Banns register

	&nbsp;

  [Top](#index)

1. <a id="registers"></a>How do I create an entry in a register?

	Go to "Home" and click "Manage Registers".
	Now, click the link to the relevant register.
	In the right sidebar, click the "Create Sacrament Record" link, e.g "Create BaptismRecord".
  Fill the form and click "Create" to create an entry in the register.

  [Top](#index)

1. <a id="certificate-types"></a>What kind of certificates are available?

	Certificates are available based on different registers:

	  1. Marriage Certificates
	  1. Baptism Certificates
	  1. First Communion Certificates
	  1. Confirmation Certificates
	  1. Death Certificates
	  1. Banns Request Letters
	  1. Banns Response Letters
	  1. No Impediment Letters

	&nbsp;

  [Top](#index)

1. <a id="certificates"></a>How do I create a sacramental certificate (baptism / first communion / confirmation / marriage)?

	First, create an entry in the corresponding register by following the instructions [here](#registers).
	Next, click "List Sacrament Record" in the right sidebar
	Click the link (id) to view the relevant record.
	Now, click the "Create Certificate" link, you should see a form.
	Fill and save the form clicking "Create" button.
	Once created, you are taken to the view page. Click the "Download Certificate" link.

  [Top](#index)

<?php $this->endWidget();?>
