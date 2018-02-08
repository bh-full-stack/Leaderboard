import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PasswordChangerComponent } from './password-changer.component';

describe('PasswordChangerComponent', () => {
  let component: PasswordChangerComponent;
  let fixture: ComponentFixture<PasswordChangerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PasswordChangerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PasswordChangerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
