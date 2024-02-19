//該当年月のシートを返す関数
function getSheetTab() {
    //今日の日付取得
    const today = new Date();
    //年取得
    const currentYear = today.getFullYear();
    //月取得,getMonth()メソッドが0~11を返すため+1(謎)
    const currentMonth = today.getMonth() + 1;
    //年と月をまとめる
    const currentYearMonth = currentYear + '-' + currentMonth;
    //スプシ全体取得
    const spreadSheet = SpreadsheetApp.openById('16kG4TNGGloQPvIhStwlvmPLQjOevP22cvxKJfkwLY9A')
    // const spreadSheet = SpreadsheetApp.getActiveSpreadsheet();
    //スプシ内の全てのシートを取得
    const sheets = spreadSheet.getSheets();
    //現在の日付のシートを取得
    for (let i = 0; i < sheets.length; i++) {
      let sheet = sheets[i];
      let yearCell = sheet.getRange("D4").getValue(); // シートのD4セルから年を取得
      let monthCell = sheet.getRange("E4").getValue(); // シートのE4セルから月を取得
      let sheetYearMonth = yearCell + "-" + monthCell;
  
      //現在の年・月とシート内の年・月データが一致するシートを返す
      if (sheetYearMonth === currentYearMonth) {
        return sheet; 
      }
    }
  }  
  
  function getTodayColumn() {
    const getsheet = getSheetTab();
    // D13 から AH13 までの範囲内の値を取得
    const values = getsheet.getRange("D13:AH13").getValues()[0]; // 1行目の値を取得
  
    // 本日の日付を取得
    const today = new Date();
    today.setHours(0, 0, 0, 0); // 時刻をゼロに設定して日付のみを比較
  
    // 値を比較して本日の日付を含む列を検索
    for (let i = 0; i < values.length; i++) {
      let cellValue = values[i];
      if (cellValue instanceof Date) {
        cellValue.setHours(0, 0, 0, 0); // 時刻をゼロに設定して日付のみを比較
        if (cellValue.getTime() === today.getTime()) {
          // 本日の日付が見つかった場合、列番号を返す（1から始まる列番号）
          console.log(i + 4);
          return i + 4; // D13 から始まるため、列番号を調整
        }
      }
    }
    // 本日の日付が見つからなかった場合は -1 を返す
    return -1;
  }
  function logTodayColumnDataWithCText() {
    const getsheet = getSheetTab();
    const todayColumn = getTodayColumn(); // 本日の日付の列番号を取得
  
    if (todayColumn !== -1) {
      //固定の場所
      const startRow = 17; // 開始行
     
     //
      const bArr = getsheet.getRange("B:B").getValues();
      var rowNum;
      //テキスト（’合計　出社人数’）がもし変更になったら変更
      for(let i = 0; i < bArr.length; i++){
        if(bArr[i] == '合計 出社人数'){
          //🙇scope対策
          var rowNum = i + 1;
          console.log('rowNum',rowNum);
          break; 
        }
      }
      const endRow = rowNum;
      // 指定列のセル値と同じ行のC列のテキストを取得
      const cellRange = getsheet.getRange(startRow, todayColumn, endRow - startRow + 1, 1);
      const cellValues = cellRange.getValues();
      const cTextRange = getsheet.getRange(startRow, 3, endRow - startRow + 1, 1);
      const cTextValues = cTextRange.getValues();
  
      // セル値を1次元の配列に変換
      const todayColumnData = cellValues.map(function(row) {
        return row[0];
      });
  
      // C列のテキストを1次元の配列に変換
      const cTextData = cTextValues.map(function(row) {
        return row[0];
      });
  
      // 同じ行のセル値とC列のテキストを同時に出力
      let objs = [];
      for (let i = 0; i < todayColumnData.length; i++) {
        let todayValue = todayColumnData[i];
        let cText = cTextData[i];
        console.log("出勤する人" + cText + ", 出勤時間: " + todayValue);
        const obj = {
          name:cText,
          time:todayValue
        }
        objs.push(obj);
      }
      console.log(objs);
      return(objs);
    } else {
      console.log("本日の日付の列が見つかりませんでした。");
    }
  }
  function postToSlack() {
    // Webhook URLを指定
    const url = 'https://hooks.slack.com/services/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'; 
    // スプレッドシートのテキストを取得
    // const text = getSpreadsheetData();
    const getsheet = getSheetTab();
    const todayColumn = getTodayColumn(); 
    const mentorArray = logTodayColumnDataWithCText();
    
    // const mentorsData = textGet;
    const validMentorsData = mentorArray.filter(mentor => mentor.time.trim() !== '' );
    const validDevMentorsData = validMentorsData.filter(mentor => !mentor.time.trim().startsWith('^') );
    console.log('validMentorsData',validMentorsData)
    let onsiteMentors = [];
  
    // 本日の出勤メンター（オンライン）を格納する変数
    let onlineMentors = [];
  
    // 本日の日付を取得
    const today = new Date();
    const todayString = today.toLocaleDateString();
    // メンターデータを処理
    validDevMentorsData.forEach(mentor => {
      const isOnsite = !mentor.time.startsWith('*');
      console.log('iusOnsite',isOnsite); 
      const formattedTime = mentor.time.replace(/^\*/g, ''); // '*' を削除
      console.log('formattedTime',formattedTime);
      // メンターの出勤情報を整形
      const mentorInfo = `${mentor.name}(${formattedTime})`;
  
      // オンサイトまたはオンラインに分類
      if (isOnsite) {
        onsiteMentors.push(mentorInfo);
      } else {
        onlineMentors.push(mentorInfo);
      }
    });
  
    const ignoreNewlineAfterNumber = text => {
      return text.replace(/(\d+)\n/g, '$1 ');
    };
    // 出力用のテキストを生成
    const onsiteText = `
  - ${onsiteMentors.join('\n- ')}
    `;
  
    const onlineText = `
  - ${onlineMentors.join('\n- ')}
    `;
    const onsiteFormattedText = ignoreNewlineAfterNumber(onsiteText);
    const onlineFormattedText = ignoreNewlineAfterNumber(onlineText);
  
    const sendText = `
    <!channel>
  ■本日の出勤メンター（校舎）
  ${onsiteFormattedText}
  
  ■本日の出勤メンター（オンライン）
  ${onlineFormattedText}
  
    `;
  
    console.log(sendText);
      // スラックに送信するデータを作成
      const payload = {
          "text": sendText,
          "username" : "出勤告知",
          "icon_emoji": "",
      };
    
      const options = {
          "method" : "post",
          "contentType" : "application/json",
          "payload" : JSON.stringify(payload)
      };
    
      // HTTP リクエストでPOST送信
      UrlFetchApp.fetch(url, options);
  }
  
  
  
  
  
  