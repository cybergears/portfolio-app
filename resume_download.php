<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">
<head>
    <title><?php echo APP_NAME; ?> - Download</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    .bg-primary{
        background-color: grey !important;
    }
    </style>
</head>
<body>

<table class="table" id="element-to-print">
    <tr>
        <td class="text-center">RESUME <br /></td>
    </tr>
    <tr class="text-center">
        <td>
            <img src="<?php echo BASEPATH.'/assets/images/'.$profile_data['user_basic_details'][0]['admin_profile_pic']; ?>" class="img-thumbnail" style="width:150px; height:auto; border-radius:150px;" alt="<?php echo APP_NAME; ?>" />
            <br />
            <b><?php echo APP_NAME; ?></b>
            <br />
            <p><?php echo $web_setting->tagline; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <b class="h4">About</b> <br />
            <p  style="text-align:justify !important;"><?php echo $web_setting->site_description; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <b class="h4">Skills</b> <br />
            <?php echo $profile_data['skills']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <b class="h4">Experience</b> <br />
            <?php echo $profile_data['experience']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <b class="h4">Education</b> <br />
            <?php echo $profile_data['education']; ?>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <b class="h4">Personal Information</b> <br />
            <p>Age: <?php echo $db_query->calculateYearDifference(date('Y-m-d'),$web_setting->dob); ?></p> 
            <p>Email: <?php echo $web_setting->email; ?></p> 
            <p>Phone: <?php echo $web_setting->phone; ?></p> 
            <p>Address: <?php echo $web_setting->address; ?></p> 
            <p>Language: <?php echo $web_setting->languages; ?></p> 
            <p>Updated On: <?php echo date('Y-m-d'); ?></p>
            
        </td>
    </tr>
</table>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var element = document.getElementById('element-to-print');
        var options = {
            margin: [2, 2, 2, 2],
            filename: '<?php echo APP_NAME; ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                logging: true,
                dpi: 192,
                letterRendering: true
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            },
            pagebreak: {
                avoid: '.dta_box'
            }

        };

        html2pdf().set(options).from(element).toPdf().save();
    </script>
</body>
</html>