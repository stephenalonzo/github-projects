//<![CDATA[
bkLib.onDomLoaded(function () {
    new nicEditor({
        fullPanel: true
    }).panelInstance('advDesc');
    $('.nicEdit-panelContain').parent().width('100%');
    $('.nicEdit-panelContain').parent().next().width('99.8%');
    $('.nicEdit-main').width('100%');
    // new nicEditor({
    //     fullPanel: true
    // }).panelInstance('area2');
    // new nicEditor({
    //     iconsPath: '../nicEditorIcons.gif'
    // }).panelInstance('area3');
    // new nicEditor({
    //     buttonList: ['fontSize', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'html', 'image']
    // }).panelInstance('area4');
    // new nicEditor({
    //     maxHeight: 100
    // }).panelInstance('area5');

    // myNiceEditor.addInstance(niceEditTextAreaSelectorClientID);
    // if (myNiceEditor.nicInstances[0].getContent() == "<br>" || myNiceEditor.nicInstances[0].getContent() == "&nbsp;") {
    //     myNiceEditor.nicInstances[0].setContent('');
    //     myNiceEditor.nicInstances[0].setContent('');
    // }
});
//]]>