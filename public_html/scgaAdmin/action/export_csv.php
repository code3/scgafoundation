<?php
switch ($_GET['section'])
{
    case 'facility':
        require 'library/php/pl_v2.php';
        require 'data/facility/main.php';
        $fileName = 'Facilities.csv';
        break;
    case 'organization':
        require 'library/php/pl_v2.php';
        require 'data/organization/main.php';
        $fileName = 'Organizations.csv';
        break;
    case 'tracking':
        require 'library/php/pl_v2.php';
        require 'data/tracking/main.php';
        $fileName = 'YOC Tracking.csv';
        break;
    case 'kids':
        require 'library/php/pl_v2.php';
        require 'data/kids/main.php';
        $fileName = 'Kids.csv';
        break;
    case 'purchase':
        require 'library/php/pl_v2.php';
        require 'data/purchase/main.php';
        $fileName = 'Online Purchases.csv';
        break;
    case 'online_donation':
        require 'library/php/pl_v2.php';
        require 'data/online_donation/main.php';
        $fileName = 'Online Donations.csv';
        break;
    case 'yoc_membership':
        require 'library/php/pl_v2.php';
        require 'data/yoc_membership/main.php';
        $fileName = 'Yoc Membership.csv';
        break;

    default:
        $_SESSION[PREFIX . 'error'] = $_p . ' export csv invalid section';
        died(CLIENTROOT . '/error');
}

$data_list = $_mysql->get($_query);

$exportList = array();
foreach ($data_list as $data)
{
    $newRow = array();
    foreach ($_excel_cols as $field => $header)
    {
        if ($_GET['csv_' . $field] != '0')
        {
            //--- FOR CONTACTS ---///
            if ($field == 'contacts' && $data['contactid'] != '0')
            {
                $i = 1;
                $_contacts = $_mysql->get('SELECT * FROM contact WHERE contactid = ' . $data['contactid'] . ' ORDER BY `primary` DESC, lname, fname');
                $numContacts = sizeof($_contacts);
                if ($_contacts)
                {
                    foreach ($_contacts as $contact)
                    {
                        $newRow['First Name ' . $i] = $contact['fname'];
                        $newRow['Last Name ' . $i] = $contact['lname'];
                        $newRow['Position ' . $i] = $contact['position'];
                        $newRow['Work Phone ' . $i] = $contact['work'];
                        $newRow['Cell Phone ' . $i] = $contact['cell'];
                        $newRow['Email ' . $i] = $contact['email'];
                        $i++;
                    }
                    if ($i == 2)
                    {
                        $newRow['First Name 2'] = '';
                        $newRow['Last Name 2'] = '';
                        $newRow['Position 2'] = '';
                        $newRow['Work Phone 2'] = '';
                        $newRow['Cell Phone 2'] = '';
                        $newRow['Email 2'] = '';

                        $newRow['First Name 3'] = '';
                        $newRow['Last Name 3'] = '';
                        $newRow['Position 3'] = '';
                        $newRow['Work Phone 3'] = '';
                        $newRow['Cell Phone 3'] = '';
                        $newRow['Email 3'] = '';

                    }
                    if ($i == 3)
                    {
                        $newRow['First Name 3'] = '';
                        $newRow['Last Name 3'] = '';
                        $newRow['Position 3'] = '';
                        $newRow['Work Phone 3'] = '';
                        $newRow['Cell Phone 3'] = '';
                        $newRow['Email 3'] = '';
                    }

                }
                else
                {
                    $newRow['First Name 1'] = '';
                    $newRow['Last Name 1'] = '';
                    $newRow['Position 1'] = '';
                    $newRow['Work Phone 1'] = '';
                    $newRow['Cell Phone 1'] = '';
                    $newRow['Email 1'] = '';

                    $newRow['First Name 2'] = '';
                    $newRow['Last Name 2'] = '';
                    $newRow['Position 2'] = '';
                    $newRow['Work Phone 2'] = '';
                    $newRow['Cell Phone 2'] = '';
                    $newRow['Email 2'] = '';

                    $newRow['First Name 3'] = '';
                    $newRow['Last Name 3'] = '';
                    $newRow['Position 3'] = '';
                    $newRow['Work Phone 3'] = '';
                    $newRow['Cell Phone 3'] = '';
                    $newRow['Email 3'] = '';
                }
            }

            //--- END CONTACTS ---///

            //--- FOR GRANTS ---///
            else if ($field == 'grants')
            {
                $i = 1;
                $_grants = $_mysql->get('SELECT * FROM `grant` WHERE organizationid = "' . $data['organizationid'] . '" ORDER BY year, amount');
                $numGrants = sizeof($_grants);
                if ($_grants)
                {
                    $grantStr = '';
                    foreach ($_grants as $grant)
                    {
                        $grantStr .= 'GRANT ' . $i . ': Year: ' . $grant['year'] . ', Amount: ' . $grant['amount'];
                        if ($i < $numGrants)
                        {
                            $grantStr .= ' / ';
                        }
                        $i++;
                    }
                    $newRow['Grants'] = $grantStr;
                }
                else
                {
                    $newRow['Grants'] = '';
                }
            }
            //--- END GRANTS ---///
            //--- FOR DONATIONS ---///
            else if ($field == 'donations')
            {
                $i = 1;
                $_donations = $_mysql->get('SELECT * FROM donation WHERE organizationid = "' . $data['organizationid'] . '" ORDER BY date');
                $numDonations = sizeof($_donations);
                if ($_donations)
                {
                    $donationStr = '';
                    foreach ($_donations as $donation)
                    {
                        $donationStr .= 'DONATION ' . $i . ': Date: ' . date("m/d/Y", strtotime($donation['date'])) . ', Items: ' . $donation['item'] . ', Quantity: ' . $donation['quantity'] . ', Value: ' . $donation['value'];
                        if ($i < $numDonations)
                        {
                            $donationStr .= ' / ';
                        }

                        $i++;
                    }

                    $newRow['Donations'] = $donationStr;
                }
                else
                {
                    $newRow['Donations'] = '';
                }
            }
            //--- END DONATIONS ---///
            //--- FOR CERTIFICATION YEARS ---///
            else if ($field == 'certification')
            {
                $i = 1;
                $year = date('Y');

                $_certifications = $_mysql->get('SELECT * FROM certification WHERE scga = "' . $data['scga'] . '"  ORDER BY certificationid');
                $numCertifications = sizeof($_certifications);
                if ($_certifications)
                {
                    $certificationStr = '';
                    foreach ($_certifications as $certification)
                    {
                        $certificationStr .= 'CERTIFICATION ' . $i . ': Year: ' . $certification['year'] . ' Status: ' . $certification['certification_status'];
                        if ($i < $numCertifications)
                        {
                            $certificationStr .= ' / ';
                        }

                        $i++;
                    }

                    $newRow['Certifications'] = $certificationStr;
                }
                else
                {
                    $newRow['Certifications'] = '';
                }
            }
            //--- END CERTIFICATION YEARS ---///
            //--- FOR ONLINE DONATIONS ---///
            else if ($field == 'memorial_donation' || $field == 'tax_deductible' || $field == 'recurring')
            {
                if ($data[$field])
                {
                    $newRow[$header] = 'Yes';
                }
                else
                {
                    $newRow[$header] = 'No';
                }
            }

            //--- END ONLINE DONATIONS ---///
            else
            {
                $newRow[$header] = $data[$field];
            }
        }
    }

    array_push($exportList, $newRow);
}

require_once('library/php/create_csv.php');
exportCsv($exportList, $fileName);
?>