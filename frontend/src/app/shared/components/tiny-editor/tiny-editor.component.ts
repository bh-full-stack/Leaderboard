import { Component, AfterViewInit, EventEmitter, OnDestroy, Input, Output } from '@angular/core';

import 'tinymce';
import 'tinymce/themes/modern';

import 'tinymce/plugins/table';
import 'tinymce/plugins/link';

declare var tinymce: any;

@Component({
  selector: 'app-tiny-editor',
  template: `<textarea id="{{id}}"></textarea>`,
  styleUrls: ['./tiny-editor.component.css']
})

export class TinyEditorComponent implements AfterViewInit, OnDestroy {

  @Input() id: string;
  @Input() ngModel: string;
  @Output() ngModelChange = new EventEmitter<string>();
 
  private _editor: any;
 
  public ngAfterViewInit() {
    tinymce.init({
      selector: '#' + this.id,
      plugins: ['link'],
      menu: {},
      skin_url: '/assets/skins/lightgray',
      content_css: '/assets/styles.css',
      setup: editor => {
        this._editor = editor;
        editor.on('init', () => {
          editor.setContent(this.ngModel);
        });
        editor.on('keyup change', () => {
          this.ngModelChange.emit(editor.getContent());
        });
      }
    });
  }

  public ngOnChanges() {
    if (this._editor) {
      this._editor.setContent(this.ngModel);
    }
  }

  public ngOnDestroy() {
    tinymce.remove(this._editor);
  }

}
