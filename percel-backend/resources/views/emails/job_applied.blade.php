<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Job Application Notification</title>

  <style type="text/css">
    .ReadMsgBody {
      width: 100%;
      background-color: #ffffff;
    }
    .ExternalClass {
      width: 100%;
      background-color: #ffffff;
    }
    body {
      width: 100%;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      font-family: Arial, Helvetica, sans-serif
    }
    table {
      border-collapse: collapse;
    }
    @media only screen and (max-width: 640px) {
      body[yahoo] .deviceWidth { width: 440px !important; padding: 0; }
      body[yahoo] .center { text-align: center !important; }
    }
    @media only screen and (max-width: 479px) {
      body[yahoo] .deviceWidth { width: 280px !important; padding: 0; }
      body[yahoo] .center { text-align: center !important; }
    }
  </style>
</head>

<body yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">
  <!-- Wrapper -->
  <table width="100%" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:0px; border: 10px solid transparent;">

        <!-- Header -->
        <table width="700" bgcolor="#fff" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
          <tr>
            <td style="padding: 15px 10px; background: #f8f8f8;">
              <table width="680" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                  <td width="100%" class="center" style="padding: 10px 0px">
                    <a href="{{ url('/') }}">
                      <img border="0" src="{{ asset('assets/admin/images/logo.png') }}" alt="Logo" title="Logo" style="width:100px" />
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        <!-- Email Body -->
        <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin-top:20px;">
          <tr>
            <td style="font-size:14px; color:#333; font-family:Arial, Helvetica, sans-serif; line-height:22px;">
              
              <p>Dear {{ $employer->name }},</p>

              <p>This is to inform you that a new application has been submitted through the system. Please find the details below:</p>

              <p>
                <strong>Applicant Name:</strong> {{ $candidate->name }} <br>
                <strong>Position Applied For:</strong> {{ $job->job_title }} <br>
                <strong>Date of Submission:</strong> {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }} <br>
              </p>

              <p>
                You can log in to the employer portal to review the complete application and attached documents.
              </p>

              <p>
                If you have any questions or require assistance, please feel free to contact our support team.
              </p>

              <p>Best regards,<br>Print Pack Careers</p>
            </td>
          </tr>
        </table>

        <!-- Footer -->
        <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin-top:30px;">
          <tr>
            <td class="center" style="background:#011a1d;font-size:12px;color:#FFB900; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px;">
              Copyright &copy; {{ date('Y') }} 
              <a href="{{ url('/') }}" style="color: #fff; text-decoration: none;">Print Pack Careers</a>. All Rights Reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- End Wrapper -->
</body>
</html>
