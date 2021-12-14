<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    type="text/css">
  <link rel="stylesheet" href="theme.css" type="text/css">
</head>

<style>
  .formFil {
    border-bottom: 2px solid;
    padding-bottom: 5px;
  }

  .thead {
    color: #E43C8A;
    font-weight: bold;
  }

  .input {
    color: #00AECC;
  }

  table {
    text-align: right;
  }
</style>

<body>

    @php
    $id = $_GET['id'];
    $data = App\Models\Patient::find($id);
    @endphp

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-danger text-center display-4">مستشفى صحة المرأة</h1>
          <h1 class="text-danger text-center display-5" style="font-weight: bold;">Women's Health Hospital</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>


        <div class="col-md-6">
          <h3 class="text-danger" style="font-weight: bold;">IN-PATIENT CASE SHEET</h3>
        </div>
        <div style="float: right;text-align: right;" class="col-md-6">
          <h3 class="text-danger" style="font-weight: bold;">استمارة المرضى الداخلين</h3>
        </div>
        <div class="col-md-12">
          <br>
        </div>

        <div class="col-md-12">
          <table class="table table-bordered" dir="rtl">
            <tr>
              <th class="thead">رقم الغرفة</th>
              <th class="input">15578</th>
              <th class="thead">المرض</th>
              <th class="input" colspan="7">عقم</th>
            </tr>
            <tr>
              <th class="thead">اسم المريض الرباعي</th>
              <th class="input" colspan="7">{{$data->name}}</th>

            </tr>
            <tr>
              <th class="thead">أسم الزوج/ة</th>
              <th class="input" colspan="7">{{$data->husbandname ??""}}</th>

            </tr>

            <tr>
              <th class="thead">أسم الأم الثلاثي</th>
              <th class="input">{{$data->mother ??""}}</th>
              <th class="thead">العمر</th>
              <th class="input" colspan="5">{{$data->motherage ??""}}</th>
            </tr>
            <tr>
              <th class="thead">المهنة</th>
              <th class="input">{{$data->job ??""}}</th>
              <th class="thead">الجنسية</th>
              <th class="input" colspan="5">{{$data->Nationality ??""}}</th>
            </tr>
            <tr>
              <th class="thead">رقم البطاقة الموحدة</th>
              <th class="input">4875</th>
              <th class="thead">تاريخ الأنتهاء</th>
              <th class="input">10/03/2021</th>
              <th class="thead">جهة الأصدار</th>
              <th class="input" colspan="3">عراق</th>
            </tr>

            <tr>
              <th class="thead">السجل المدني</th>
              <th class="input">{{$data->identity_book}}</th>
              <th class="thead">الدائرة</th>
              <th class="input">{{$data->identity_circule}}</th>
              <th class="thead">رقم الصحيفة</th>
              <th class="input">{{$data->identity_page}}</th>
              <th class="thead">رقم الهوية</th>
              <th class="input">XXX</th>
            </tr>

            <tr>
              <th class="thead">أقرب شخص له</th>
              <th class="input">{{$data->relaitve_name}}</th>
              <th class="thead">عنوانه والهاتف</th>
              <th class="input">xxxxx</th>
              <th class="input" colspan="4">{{$data->relaitve_phone}}</th>
            </tr>

            <tr>
              <th class="thead">الطبيب المعالج</th>
              <th class="input" colspan="7">{{$data->doctor->name ??""}}</th>
            </tr>
            <tr>
              <th class="thead">تاريخ الدخول</th>
              <th class="input">{{$data->inter_at}}</th>
              <th class="thead">تاريخ الخروج</th>
              <th class="input" colspan="5"></th>
            </tr>

          </table>
        </div>

        <div class="col-md-12">
          <h4 class="thead" style="text-align: center;">تعهد خطي بموافقة المريض وذويه على اجراء التدخلات والفحوصات
            الطبية والعمليات الجراحية</h4>

          <h5 dir="rtl" style="text-align: right;color: #E43C8A;font-weight: 400;">
            اني المريض............................................................................المـوقع أدناه والراقد
            في ردهة .....................................................في مستشفى
            ..............................................اطلعني الطبيب المعالج
            ..................................................انا وعائلتي (الموقعين أدناه)على طبيعة مرضي وعلى طبيعة
            التداخلات والفحوصات الطبية كافة (العلاجية والعمليات الجراحية) اللازمة لعلاجي من مرضي وبضمنها المخاطر
            والمضاعفات التي قد تنجم عن تلك التداخلات او الفحوصات (بما فيها الوفاة) كما اوافق انا وعائلتي على أن يعطي لي
            التخدير من قبل طبيب التخدير المخول وبالطريقة التي يرتأيها مناسبة لحالتي وكما اخول الطبيب المعالج طلب
            المساعدة او استشارة طبيب اخر عند الضرورة .كما اتعهد بعدم التعرض بالتهديد العشائري للكادر الطبي والتمريضي
            المعالج في حالة حدوث المضاعفات الطبية او ألاخطاء غير المقصودة وأن نسلك الطرق القانونية للمطالبة بحقنا منهم
            وبخلافه نكون تحت طائلة المادة (1) من القرار (24) لسنة 1997 الذي اشار الى العقوبة بالحبس لمدة لاتقل عن ثلاث
            سنوات في حالة المطالبة العشائرية ويعتبر هذا إقرار شامل نوقعه بكامل حريتنا بتاريخ / / 20 في حالة تعذر قيام
            المريض بالتوقيع على تعهد لكونه قاصر او متخلفاً عقلياً او فاقد للوعي في حالة طارئة لا يمكنه التوقيع يقوم أحد
            افراد اسرته بالتوقيع نيابه عنه (على ان يكون من الدرجة الاولى او الثانية من القرابة)يستثنى من ذلك تعرض حياة
            المريض للخطر او الموت عند تأخر إجرائها فيجوز عند اذن إجراء ما تطلبه حاله المريض دون تحقيق الموافقة المذكورة
            استناداً لقانون الصحة العامة رقم (89)لسنة 1981 الباب الرابع الفرع ألاول المادة (91) الفقرة(ب)
          </h5>

        </div>
        <div class="col-md-12">
          <br>
          <br>
        </div>
        <div class="col-md-12">
          <table class="table" dir="rtl">
            <th class="thead">أسم وتوقيع
              الممرضة المسؤولة
            </th>
            <th class="thead">
              أسم وتوقيع الزوج او الزوجة او القريب
              من الدرجة الاولى إن امكن
              رقم وتاريخ الهوية

            </th>
            <th class="thead">
              أسم وتوقيع المريض او ولي
              أمره
              رقم وتاريخ الهوية

            </th>
          </table>
        </div>













      </div>
      <img width="100%" height="100%" src="formimages/img1.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img2.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img3.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img4.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img5.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img6.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img7.jpg" alt="" srcset="">
      <p style="page-break-after: always;">&nbsp;</p>
      <p style="page-break-before: always;">&nbsp;</p>
      <img width="100%" src="formimages/img8.jpg" alt="" srcset="">
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  
  <script>
    setTimeout(() => {
        window.print();
    }, 1000);
  </script>

</body>

</html>