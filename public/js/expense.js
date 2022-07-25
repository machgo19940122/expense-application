//経費修正画面で申請を取り下げる際の確認ポップアップ
function delete_alert(e){
  //キャンセルが選択された時
   if(!window.confirm('本当に申請を取り下げますか？OKを押すとデータは消去されます。')){
      return false;
   }
   //OKが押されたとき
   document.deleteform.submit();
};