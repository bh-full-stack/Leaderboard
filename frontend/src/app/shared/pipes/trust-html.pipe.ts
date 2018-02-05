import { Pipe, PipeTransform } from '@angular/core';
import { SafeHtml, DomSanitizer } from '@angular/platform-browser';

@Pipe({
  name: 'trustHtml'
})
export class TrustHtmlPipe implements PipeTransform {

  public constructor(private _domSanitizer: DomSanitizer) {
    //
  }
  
  public transform(value: string): SafeHtml {
    return this._domSanitizer.bypassSecurityTrustHtml(value);
  }

}
