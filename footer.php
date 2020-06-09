<?php
  if(strcmp($lang,'en')==0){
    $contactFooter = "Contact";
    $legal = "Legal";
  }
  else if(strcmp($lang,'spa')==0){
    $contactFooter = "Contacto";
    $legal = "MENCIONES LEGALES";
  }
  else{
    $contactFooter = "Contact";
    $legal = "MENTIONS LEGALES";

  }
?>


<!--Google Business icon Style from flat icon-->
<style type="text/css">div.image {max-width: 256px;max-height: 256px;background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6IzUxOEVGODsiIGQ9Ik00ODEuMjQxLDIwMS40NTN2MjQ4LjQxOWMwLDE2LjU0NC0xMy4zOTIsMjkuOTQ4LTI5Ljk0OCwyOS45NDhINjAuNjk0ICBjLTE2LjU0NCwwLTI5Ljk0OC0xMy40MDUtMjkuOTQ4LTI5Ljk0OFYyMDEuNDUzYzkuMzI3LDUuNTE5LDIwLjIxLDguNjgzLDMxLjgyNiw4LjY4M2MxNS44MjMsMCwzMC4zODYtNS45MDUsNDEuNDg3LTE1LjczMyAgYzExLjEwMi05LjgxNSwxOC43MTgtMjMuNTgsMjAuNjM0LTM5LjI3NWwyLjEzNS0xNy41NDdjLTAuMzA5LDIuNjM3LTAuNDc2LDUuMjc0LTAuNDc2LDcuODZjMCwzNS4yMSwyOC42MjMsNjQuNjk1LDY0LjgyMyw2NC42OTUgIGMzNS44MDEsMCw2NC44MjMtMjkuMDIyLDY0LjgyMy02NC44MWMwLDM1Ljc4OSwyOS4wMDksNjQuODEsNjQuODEsNjQuODFjMzYuMjI2LDAsNjQuODM2LTI5LjQ4NSw2NC44MzYtNjQuNzIgIGMwLTIuNTYtMC4xNTQtNS4xNDYtMC40NzYtNy43N2wyLjEzNSwxNy40ODNjMS45MTcsMTUuNjk0LDkuNTMyLDI5LjQ1OSwyMC42MjIsMzkuMjc1YzExLjEwMiw5LjgyOCwyNS42NzcsMTUuNzMzLDQxLjQ4NywxNS43MzMgIEM0NjEuMDMyLDIxMC4xMzcsNDcxLjkxNSwyMDYuOTcyLDQ4MS4yNDEsMjAxLjQ1M3oiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzQ3ODZFMjsiIGQ9Ik00ODEuMjQxLDI1MC4zODV2MzAuMDEyYy05LjMyNyw1LjUxOS0yMC4yMSw4LjY4My0zMS44MjYsOC42ODNjLTE1LjgxLDAtMzAuMzg1LTUuOTA1LTQxLjQ4Ny0xNS43MzMgIGMtMTEuMDg5LTkuODE1LTE4LjcwNS0yMy41OC0yMC42MjItMzkuMjc1bC0yLjEzNS0xNy40ODNjMC4zMjIsMi42MjQsMC40NzYsNS4yMSwwLjQ3Niw3Ljc3YzAsMzUuMjM1LTI4LjYxLDY0LjcyLTY0LjgzNiw2NC43MiAgYy0zNS44MDEsMC02NC44MS0yOS4wMjItNjQuODEtNjQuODFjMCwzNS43ODktMjkuMDIyLDY0LjgxLTY0LjgyMyw2NC44MWMtMzYuMiwwLTY0LjgyMy0yOS40ODUtNjQuODIzLTY0LjY5NSAgYzAtMi41ODYsMC4xNjctNS4yMjMsMC40NzYtNy44NmwtMi4xMzUsMTcuNTQ3Yy0xLjkxNywxNS42OTQtOS41MzIsMjkuNDU5LTIwLjYzNCwzOS4yNzUgIGMtMTEuMTAyLDkuODI4LTI1LjY2NCwxNS43MzMtNDEuNDg3LDE1LjczM2MtMTEuNjE2LDAtMjIuNS0zLjE2NS0zMS44MjYtOC42ODN2LTMwLjAxMmM5LjMyNyw1LjUxOSwyMC4yMSw4LjY4MywzMS44MjYsOC42ODMgIGMxNS44MjMsMCwzMC4zODYtNS45MDUsNDEuNDg3LTE1LjczM2MxMS4xMDItOS44MTUsMTguNzE4LTIzLjU4LDIwLjYzNC0zOS4yNzVsMi4xMzUtMTcuNTQ3Yy0wLjMwOSwyLjYzNy0wLjQ3Niw1LjI3NC0wLjQ3Niw3Ljg2ICBjMCwzNS4yMSwyOC42MjMsNjQuNjk1LDY0LjgyMyw2NC42OTVjMzUuODAxLDAsNjQuODIzLTI5LjAyMiw2NC44MjMtNjQuODFjMCwzNS43ODksMjkuMDA5LDY0LjgxLDY0LjgxLDY0LjgxICBjMzYuMjI2LDAsNjQuODM2LTI5LjQ4NSw2NC44MzYtNjQuNzJjMC0yLjU2LTAuMTU0LTUuMTQ2LTAuNDc2LTcuNzdsMi4xMzUsMTcuNDgzYzEuOTE3LDE1LjY5NCw5LjUzMiwyOS40NTksMjAuNjIyLDM5LjI3NSAgYzExLjEwMiw5LjgyOCwyNS42NzcsMTUuNzMzLDQxLjQ4NywxNS43MzNDNDYxLjAzMiwyNTkuMDY5LDQ3MS45MTUsMjU1LjkwNCw0ODEuMjQxLDI1MC4zODV6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0FDRDFGQzsiIGQ9Ik0zODUuMTcxLDE4OC41MDhjMC4zMjIsMi42MjQsMC40NzYsNS4yMSwwLjQ3Niw3Ljc3YzAsMzUuMjM1LTI4LjYxLDY0LjcyLTY0LjgzNiw2NC43MiAgIGMtMzUuODAxLDAtNjQuODEtMjkuMDIyLTY0LjgxLTY0LjgxbC0zMC44NzQtNzUuMzUxTDI1NiwzMi4xNzloMTEwLjExOWwzMy4xMDQsODguNzZsLTE0LjA2NSw2Ny40MDEgICBDMzg1LjE3MSwxODguMzkyLDM4NS4xNzEsMTg4LjQ1NywzODUuMTcxLDE4OC41MDh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQUNEMUZDOyIgZD0iTTE0NS44NjksMzIuMTgxbDI4LjY1OCw5Ny40MTZsLTQ3LjY4NCw1OC43NDR2MC4wMDFsLTIuMTQ4LDE3LjY0OSAgIGMtMS45MTcsMTUuNjk0LTkuNTMyLDI5LjQ1OS0yMC42MzQsMzkuMjc1Yy0xMS4xMDIsOS44MjgtMjUuNjY0LDE1LjczMy00MS40ODcsMTUuNzMzYy0xMS42MTYsMC0yMi41LTMuMTY1LTMxLjgyNi04LjY4M3YtMC4wMTMgICBDMTIuMzM3LDI0MS40MTksMCwyMjEuMzYzLDAsMTk4LjQyNnYtNC42NDRMNDIuNjIxLDQ3LjgxNmMyLjcwNS05LjI2NiwxMS4yMDEtMTUuNjM1LDIwLjg1NC0xNS42MzVIMTQ1Ljg2OXoiLz4KPC9nPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzQTVCQkM7IiBkPSJNNDgxLjI0MSwyNTIuMzE1Yy05LjMyNyw1LjUxOS0yMC4yMSw4LjY4My0zMS44MjYsOC42ODNjLTE1LjgxLDAtMzAuMzg1LTUuOTA1LTQxLjQ4Ny0xNS43MzMgICBjLTExLjA4OS05LjgxNS0xOC43MDUtMjMuNTgtMjAuNjIyLTM5LjI3NWwtMi4xMzUtMTcuNDgzYzAtMC4wNTEsMC0wLjExNi0wLjAxMy0wLjE2N2wtMTkuMDM5LTE1Ni4xNmg4Mi4zOTUgICBjOS42NTIsMCwxOC4xNDgsNi4zNjksMjAuODU0LDE1LjYzNEw1MTIsMTkzLjc4MnY0LjY0NEM1MTIsMjIxLjM2Myw0OTkuNjUsMjQxLjQxOSw0ODEuMjQxLDI1Mi4zMTV6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0E1QkJDOyIgZD0iTTI1NiwzMi4xODF2MTY0LjAwN2MwLDM1Ljc4OS0yOS4wMjIsNjQuODEtNjQuODIzLDY0LjgxYy0zNi4yLDAtNjQuODIzLTI5LjQ4NS02NC44MjMtNjQuNjk1ICAgYzAtMi41ODYsMC4xNjctNS4yMjMsMC40NzYtNy44NmMwLTAuMDM5LDAuMDEzLTAuMDY0LDAuMDEzLTAuMTAzbDE5LjAyNi0xNTYuMTZIMjU2eiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMzg0LjcwOCw0NDUuNDg2Yy0zNS40ODEsMC02NC4zNDctMjguODY2LTY0LjM0Ny02NC4zNDdzMjguODY2LTY0LjM0Nyw2NC4zNDctNjQuMzQ3ICBjMTcuMTk0LDAsMzMuMzU2LDYuNjkyLDQ1LjUwNiwxOC44NDFsLTEzLjY0NCwxMy42NDRjLTguNTA2LTguNTA2LTE5LjgyMS0xMy4xOS0zMS44NjEtMTMuMTkgIGMtMjQuODQxLDAtNDUuMDUxLDIwLjIwOS00NS4wNTEsNDUuMDUxYzAsMjQuODQyLDIwLjIxLDQ1LjA1MSw0NS4wNTEsNDUuMDUxYzIxLjUzLDAsMzkuNTgxLTE1LjE4Miw0NC4wMS0zNS40MDNoLTQ0LjAxMXYtMTkuMjk2ICBoNjQuMzQ3djkuNjQ4QzQ0OS4wNTUsNDE2LjYxOSw0MjAuMTg5LDQ0NS40ODYsMzg0LjcwOCw0NDUuNDg2eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K)}</style>



<!-- Footer -->
  <footer class="footer py-7">
    <div class="container text-center">

      <div class="social social-bg-pale-brand">
        <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
        <a class="social-twitter" href="#"><i class="fa fa-linkedin"></i></a>
        <!--//google business icon image from flat icons-->
        <a class="social-instagram" href="#"><img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6IzUxOEVGODsiIGQ9Ik00ODEuMjQxLDIwMS40NTN2MjQ4LjQxOWMwLDE2LjU0NC0xMy4zOTIsMjkuOTQ4LTI5Ljk0OCwyOS45NDhINjAuNjk0ICBjLTE2LjU0NCwwLTI5Ljk0OC0xMy40MDUtMjkuOTQ4LTI5Ljk0OFYyMDEuNDUzYzkuMzI3LDUuNTE5LDIwLjIxLDguNjgzLDMxLjgyNiw4LjY4M2MxNS44MjMsMCwzMC4zODYtNS45MDUsNDEuNDg3LTE1LjczMyAgYzExLjEwMi05LjgxNSwxOC43MTgtMjMuNTgsMjAuNjM0LTM5LjI3NWwyLjEzNS0xNy41NDdjLTAuMzA5LDIuNjM3LTAuNDc2LDUuMjc0LTAuNDc2LDcuODZjMCwzNS4yMSwyOC42MjMsNjQuNjk1LDY0LjgyMyw2NC42OTUgIGMzNS44MDEsMCw2NC44MjMtMjkuMDIyLDY0LjgyMy02NC44MWMwLDM1Ljc4OSwyOS4wMDksNjQuODEsNjQuODEsNjQuODFjMzYuMjI2LDAsNjQuODM2LTI5LjQ4NSw2NC44MzYtNjQuNzIgIGMwLTIuNTYtMC4xNTQtNS4xNDYtMC40NzYtNy43N2wyLjEzNSwxNy40ODNjMS45MTcsMTUuNjk0LDkuNTMyLDI5LjQ1OSwyMC42MjIsMzkuMjc1YzExLjEwMiw5LjgyOCwyNS42NzcsMTUuNzMzLDQxLjQ4NywxNS43MzMgIEM0NjEuMDMyLDIxMC4xMzcsNDcxLjkxNSwyMDYuOTcyLDQ4MS4yNDEsMjAxLjQ1M3oiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzQ3ODZFMjsiIGQ9Ik00ODEuMjQxLDI1MC4zODV2MzAuMDEyYy05LjMyNyw1LjUxOS0yMC4yMSw4LjY4My0zMS44MjYsOC42ODNjLTE1LjgxLDAtMzAuMzg1LTUuOTA1LTQxLjQ4Ny0xNS43MzMgIGMtMTEuMDg5LTkuODE1LTE4LjcwNS0yMy41OC0yMC42MjItMzkuMjc1bC0yLjEzNS0xNy40ODNjMC4zMjIsMi42MjQsMC40NzYsNS4yMSwwLjQ3Niw3Ljc3YzAsMzUuMjM1LTI4LjYxLDY0LjcyLTY0LjgzNiw2NC43MiAgYy0zNS44MDEsMC02NC44MS0yOS4wMjItNjQuODEtNjQuODFjMCwzNS43ODktMjkuMDIyLDY0LjgxLTY0LjgyMyw2NC44MWMtMzYuMiwwLTY0LjgyMy0yOS40ODUtNjQuODIzLTY0LjY5NSAgYzAtMi41ODYsMC4xNjctNS4yMjMsMC40NzYtNy44NmwtMi4xMzUsMTcuNTQ3Yy0xLjkxNywxNS42OTQtOS41MzIsMjkuNDU5LTIwLjYzNCwzOS4yNzUgIGMtMTEuMTAyLDkuODI4LTI1LjY2NCwxNS43MzMtNDEuNDg3LDE1LjczM2MtMTEuNjE2LDAtMjIuNS0zLjE2NS0zMS44MjYtOC42ODN2LTMwLjAxMmM5LjMyNyw1LjUxOSwyMC4yMSw4LjY4MywzMS44MjYsOC42ODMgIGMxNS44MjMsMCwzMC4zODYtNS45MDUsNDEuNDg3LTE1LjczM2MxMS4xMDItOS44MTUsMTguNzE4LTIzLjU4LDIwLjYzNC0zOS4yNzVsMi4xMzUtMTcuNTQ3Yy0wLjMwOSwyLjYzNy0wLjQ3Niw1LjI3NC0wLjQ3Niw3Ljg2ICBjMCwzNS4yMSwyOC42MjMsNjQuNjk1LDY0LjgyMyw2NC42OTVjMzUuODAxLDAsNjQuODIzLTI5LjAyMiw2NC44MjMtNjQuODFjMCwzNS43ODksMjkuMDA5LDY0LjgxLDY0LjgxLDY0LjgxICBjMzYuMjI2LDAsNjQuODM2LTI5LjQ4NSw2NC44MzYtNjQuNzJjMC0yLjU2LTAuMTU0LTUuMTQ2LTAuNDc2LTcuNzdsMi4xMzUsMTcuNDgzYzEuOTE3LDE1LjY5NCw5LjUzMiwyOS40NTksMjAuNjIyLDM5LjI3NSAgYzExLjEwMiw5LjgyOCwyNS42NzcsMTUuNzMzLDQxLjQ4NywxNS43MzNDNDYxLjAzMiwyNTkuMDY5LDQ3MS45MTUsMjU1LjkwNCw0ODEuMjQxLDI1MC4zODV6Ii8+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6I0FDRDFGQzsiIGQ9Ik0zODUuMTcxLDE4OC41MDhjMC4zMjIsMi42MjQsMC40NzYsNS4yMSwwLjQ3Niw3Ljc3YzAsMzUuMjM1LTI4LjYxLDY0LjcyLTY0LjgzNiw2NC43MiAgIGMtMzUuODAxLDAtNjQuODEtMjkuMDIyLTY0LjgxLTY0LjgxbC0zMC44NzQtNzUuMzUxTDI1NiwzMi4xNzloMTEwLjExOWwzMy4xMDQsODguNzZsLTE0LjA2NSw2Ny40MDEgICBDMzg1LjE3MSwxODguMzkyLDM4NS4xNzEsMTg4LjQ1NywzODUuMTcxLDE4OC41MDh6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojQUNEMUZDOyIgZD0iTTE0NS44NjksMzIuMTgxbDI4LjY1OCw5Ny40MTZsLTQ3LjY4NCw1OC43NDR2MC4wMDFsLTIuMTQ4LDE3LjY0OSAgIGMtMS45MTcsMTUuNjk0LTkuNTMyLDI5LjQ1OS0yMC42MzQsMzkuMjc1Yy0xMS4xMDIsOS44MjgtMjUuNjY0LDE1LjczMy00MS40ODcsMTUuNzMzYy0xMS42MTYsMC0yMi41LTMuMTY1LTMxLjgyNi04LjY4M3YtMC4wMTMgICBDMTIuMzM3LDI0MS40MTksMCwyMjEuMzYzLDAsMTk4LjQyNnYtNC42NDRMNDIuNjIxLDQ3LjgxNmMyLjcwNS05LjI2NiwxMS4yMDEtMTUuNjM1LDIwLjg1NC0xNS42MzVIMTQ1Ljg2OXoiLz4KPC9nPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiMzQTVCQkM7IiBkPSJNNDgxLjI0MSwyNTIuMzE1Yy05LjMyNyw1LjUxOS0yMC4yMSw4LjY4My0zMS44MjYsOC42ODNjLTE1LjgxLDAtMzAuMzg1LTUuOTA1LTQxLjQ4Ny0xNS43MzMgICBjLTExLjA4OS05LjgxNS0xOC43MDUtMjMuNTgtMjAuNjIyLTM5LjI3NWwtMi4xMzUtMTcuNDgzYzAtMC4wNTEsMC0wLjExNi0wLjAxMy0wLjE2N2wtMTkuMDM5LTE1Ni4xNmg4Mi4zOTUgICBjOS42NTIsMCwxOC4xNDgsNi4zNjksMjAuODU0LDE1LjYzNEw1MTIsMTkzLjc4MnY0LjY0NEM1MTIsMjIxLjM2Myw0OTkuNjUsMjQxLjQxOSw0ODEuMjQxLDI1Mi4zMTV6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojM0E1QkJDOyIgZD0iTTI1NiwzMi4xODF2MTY0LjAwN2MwLDM1Ljc4OS0yOS4wMjIsNjQuODEtNjQuODIzLDY0LjgxYy0zNi4yLDAtNjQuODIzLTI5LjQ4NS02NC44MjMtNjQuNjk1ICAgYzAtMi41ODYsMC4xNjctNS4yMjMsMC40NzYtNy44NmMwLTAuMDM5LDAuMDEzLTAuMDY0LDAuMDEzLTAuMTAzbDE5LjAyNi0xNTYuMTZIMjU2eiIvPgo8L2c+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNMzg0LjcwOCw0NDUuNDg2Yy0zNS40ODEsMC02NC4zNDctMjguODY2LTY0LjM0Ny02NC4zNDdzMjguODY2LTY0LjM0Nyw2NC4zNDctNjQuMzQ3ICBjMTcuMTk0LDAsMzMuMzU2LDYuNjkyLDQ1LjUwNiwxOC44NDFsLTEzLjY0NCwxMy42NDRjLTguNTA2LTguNTA2LTE5LjgyMS0xMy4xOS0zMS44NjEtMTMuMTkgIGMtMjQuODQxLDAtNDUuMDUxLDIwLjIwOS00NS4wNTEsNDUuMDUxYzAsMjQuODQyLDIwLjIxLDQ1LjA1MSw0NS4wNTEsNDUuMDUxYzIxLjUzLDAsMzkuNTgxLTE1LjE4Miw0NC4wMS0zNS40MDNoLTQ0LjAxMXYtMTkuMjk2ICBoNjQuMzQ3djkuNjQ4QzQ0OS4wNTUsNDE2LjYxOSw0MjAuMTg5LDQ0NS40ODYsMzg0LjcwOCw0NDUuNDg2eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" /></a>
      </div>

      <br>

      <div class="nav nav-bolder nav-uppercase nav-center">
        <a class="nav-link1" href="#">Services</a>
        <a class="nav-link1" href="#"><?php echo $legal;?></a>
        <a class="nav-link1" href="#">Blog</a>
        <a class="nav-link1" href="#"><?php echo $contactFooter;?></a>
      </div>

      <br>

      <small>&copy; Review Thunder <?php echo date('Y');?>. All rights reserved.</small>

    </div>
  </footer><!-- /.footer -->


	<script>

function comparePassword(){
 var pwd  =	 document.getElementById("pwd").value;
 console.log(pwd);
 var conPwd = document.getElementById("conpwd").value;
 console.log(conPwd);
 
 if(pwd !== conPwd){
 	document.getElementById("conpwd").style.borderColor = "red";
 }else{
 	document.getElementById("conpwd").style.borderColor = "#0facf3";
 	document.getElementById("pwd").style.borderColor = "#0facf3";
 }
 
}


	function google_token(){
$.ajax({
   url: '<?php echo base_url2();?>gbm/examples/refreshtoken.php',
  success: function(data) {

   },
   type: 'GET'
});
}

//every 3 seconds (3000 milliseconds):
	 setInterval(function(){ 
	 google_token(); 
	},30*60*1000); 
	
	function mybusiness_token(){
$.ajax({
   url: '<?php echo base_url2();?>gbm/examples/mybusiness_token.php',
  success: function(data) {

   },
   type: 'GET'
});
}

//every 3 seconds (3000 milliseconds):
	 setInterval(function(){ 
	 mybusiness_token(); 
	},30*60*1000); 
	

	</script>
    <!-- END Footer -->
