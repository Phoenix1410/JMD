<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Responsive Email Template</title>

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
      body[yahoo] .deviceWidth {
        width: 440px !important;
        padding: 0;
      }

      body[yahoo] .center {
        text-align: center !important;
      }
    }

    @media only screen and (max-width: 479px) {
      body[yahoo] .deviceWidth {
        width: 280px !important;
        padding: 0;
      }

      body[yahoo] .center {
        text-align: center !important;
      }
    }
  </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">
  <!-- Wrapper -->
  <table width="" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:0px; border: 10px solid transparent;">

        <!--Start Header-->
        <table width="700" bgcolor="#fff" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
          <tr>
            <td style="padding: 15px 10px; background: #f8f8f8;">
              <table width="680" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                <tr>
                  <td width="100%">
                    <!--Start logo-->
                    <table cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                      <tr>
                        <td class="center" style="padding: 10px 0px 10px 0px">
                          <a href="#">
                          <img border="0" src="{{ asset('assets/admin/images/logo.png') }}" alt="Logo" title="Logo" style="width:100px" />
                          </a>
                          <!-- <a href="#">Car Services</a> -->
                        </td>
                      </tr>
                    </table><!--End logo-->
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!--End Header-->
        <p>Dear <span style="font-family: Calibri; font-size: 14.6667px; white-space: pre-wrap;">{{ $mailData['name'] }}</span>,</p>

        <p>A Job Alert for You:&nbsp; &nbsp; &nbsp; &nbsp;.</p>

        <p>Job Title:&nbsp;<span style="font-family: Calibri; font-size: 14.6667px; white-space: pre-wrap;">{!! $mailData['email_content'] !!}</span></p>

        <p><span style="font-family: Calibri; font-size: 14.6667px; white-space: pre-wrap;"></span></p>

        <p>&nbsp;</p>

        <p>&nbsp;</p>

        <p>Best Regards,</p>

        <p>Print Pack Careers</p>

        <p>&nbsp;</p>

        <p>&nbsp;</p>

        <p>&nbsp;</p>

        <!-- Footer -->
        <table width="700" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
          <tr>
            <td class="center" style="background:#011a1d;font-size:12px;color:#FFB900; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 10px 10px 10px; ">
              Copyright &copy; <?php echo date('Y'); ?> <a href="{{url('/')}}" style="color: #fff; text-decoration: none;">Print Pack Careers.</a> All Rights Reserved.
            </td>
          </tr>
        </table>
        <!--End Footer-->

      </td>
    </tr>
  </table>
  <!-- End Wrapper -->
</body>

</html>