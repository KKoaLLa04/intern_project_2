function toSlug(title){

    let slug = title.toLowerCase(); //Chuyen tat ca cac ky tu ve chu thuong

    // Lọc dữ liệu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi,'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi,'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi,'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi,'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi,'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi,'y');
    slug = slug.replace(/đ/gi,'d');

    // Chuyển ký tự khoảng trắng thành (-)
    slug = slug.replace(/ /gi,'-');
    
    // Xóa tất cả các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,'');

    return slug;
}

let sourceTitle = document.querySelector('.slug');
let slugRender = document.querySelector('.slug-render');

let renderLink = document.querySelector('.render-link');
if(renderLink!==null){
    let slugLink = renderLink.querySelector('span');

    let slug = '';
    if(slugRender!==null){
        slug = '/'+slugRender.value.trim();
    }

    if(slugLink!==null){
        slugLink.innerHTML = `<a href="${rootUrl+slug}">${rootUrl+slug}</a>`;
    }
}

if(sourceTitle!==null && slugRender!==null){
    sourceTitle.addEventListener('keyup',(e)=>{

        if(!sessionStorage.getItem('save_slug')){
            let title = e.target.value;
    
            if(title !== null){
                let slug = toSlug(title);
    
                slugRender.value = slug;
            }
        }
    })

    sourceTitle.addEventListener('change',(e)=>{
        sessionStorage.setItem('save_slug',1);

        // Xu ly get link url
        let slugLink = renderLink.querySelector('span a');
        let currentLink = rootUrl+'/'+prefixLink+'/'+slugRender.value+'.html';
        slugLink.href = currentLink;
        slugLink.innerHTML = currentLink;
    })

    slugRender.addEventListener('change',(e)=>{
        if(e.target.value==''){
            sessionStorage.removeItem('save_slug');
            let slug = sourceTitle.value;
            slug = toSlug(slug);
            e.target.value = slug;
        }

        let slugLink = renderLink.querySelector('span a');
        let currentLink = rootUrl+'/'+prefixLink+'/'+toSlug(slugRender.value)+'.html';
        slugLink.href = currentLink;
        slugLink.innerHTML = currentLink;
    })

    if(slugRender.value==''){
        sessionStorage.removeItem('save_slug');
    }


}

// Xu ly ckeditor
let classTextarea = document.querySelectorAll('.editor');
if(classTextarea!==null){
    classTextarea.forEach((item,index) => {
        item.id = 'editor_'+(index+1);
        CKEDITOR.replace(item.id);
    })
}

function openCkfinder(){
    let chooseImages = document.querySelectorAll('.choose-image');

    if(chooseImages!==null){
    
            chooseImages.forEach(function(item){
    
                item.addEventListener('click', function(){
                    let parentElementObj = this.parentElement;
                    if(parentElementObj){
                        while(parentElementObj){
    
                            parentElementObj = parentElementObj.parentElement;
    
                            if(parentElementObj.classList.contains('ckfinder-group')){
                                break;
                            }
                        }
    
                              //Code mở popup Ckfinder
                CKFinder.popup( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                    let fileUrl = evt.data.files.first().getUrl();
                    //Xử lý chèn link ảnh vào input
                        parentElementObj.querySelector('.image-render').value = fileUrl;
                        console.log(fileUrl)
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                    let fileUrl = evt.data.resizedUrl;
                    //Xử lý chèn link ảnh vào input
                    parentElementObj.querySelector('.image-render').value = fileUrl;
                    } );
                    }
                    } );
                        }
                })
            })
    }
}

openCkfinder();

const galleryItemHtml = `<div class="gallery-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row ckfinder-group">
                                        <div class="col-10">
                                            <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value=""/>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i> </a>
                                </div>
                            </div>

                        </div><!--End .gallery-item-->`;

const addGalleryObject = document.querySelector('.add-gallery');
const galleryImagesObject = document.querySelector('.gallery-images');

if (addGalleryObject!==null && galleryImagesObject!==null){
    addGalleryObject.addEventListener('click', function (e) {
       e.preventDefault();

       let galleryItemHtmlNode = new DOMParser().parseFromString(galleryItemHtml, 'text/html').querySelector('.gallery-item');

       galleryImagesObject.appendChild(galleryItemHtmlNode);

       openCkfinder();

    });

    galleryImagesObject.addEventListener('click', function(e){
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){

            if (confirm('Bạn có chắc chắn muốn xoá?')){
                let galleryItem = e.target;
                while (galleryItem) {

                    galleryItem = galleryItem.parentElement;

                    if (galleryItem.classList.contains('gallery-item')) {
                        break;
                    }
                }

                if (galleryItem !== null) {
                    galleryItem.remove();
                }

            }
        }
    });
}

const slideItemHtml = `<div class="slide-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="home_slide[slide_title][]" placeholder="Tiêu đề...." value="">
                </div>

                <div class="form-group">
                    <label for="">Mô tả</label>
                    <input type="text" class="form-control" name="home_slide[slide_desc][]" placeholder="Mô tả...." value="">
                </div>

                <div class="form-group">
                    <label for="">Chữ của nút</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_text][]" placeholder="Chữ của nút...." value="">
                </div>

                <div class="form-group">
                    <label for="">Ảnh slide 2</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_background][]" placeholder="Đường dẫn ảnh...." value="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Vị trí</label>
                    <select name="home_slide[slide_position][]" class="form-control">
                        <option value="left">Trái</option>
                        <option value="center">Giữa</option>
                        <option value="right">Phải</option>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="">Link của nút</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_link][]" placeholder="Link của nút...." value="">
                </div>

                <div class="form-group">
                    <label for="">Link youtube</label>
                    <input type="text" class="form-control" name="home_slide[slide_youtube][]" placeholder="Link youtube...." value="">
                </div>

                <div class="form-group">
                    <label for="">Ảnh slide 1</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_image_1][]" placeholder="Đường dẫn ảnh...." value="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Ảnh nền</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_image_2][]" placeholder="Đường dẫn ảnh...." value="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-1">
        <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
    </div>
</div>
</div> <!-- End slide-item-->`;

const addSlideObject = document.querySelector('.add-slide');
const gallerySlideObject = document.querySelector('.slide-wrapper');
if(addSlideObject!==null && gallerySlideObject!==null){
    addSlideObject.addEventListener('click',function(e){
        e.preventDefault();

        let slideItemHtmlNode = new DOMParser().parseFromString(slideItemHtml, 'text/html').querySelector('.slide-item');
 
        gallerySlideObject.appendChild(slideItemHtmlNode);
 
        openCkfinder();
    })

    gallerySlideObject.addEventListener('click', function(e){
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){

            if (confirm('Bạn có chắc chắn muốn xoá?')){
                let slideItem = e.target;
                while (slideItem) {

                    slideItem = slideItem.parentElement;

                    if (slideItem.classList.contains('slide-item')) {
                        break;
                    }
                }

                if (slideItem !== null) {
                    slideItem.remove();
                }

            }
        }
    });
}

$('.ranger').ionRangeSlider({
    min     : 0,
    max     : 100,
    type    : 'single',
    step    : 1,
    postfix : ' %',
    prettify: false,
    hasGrid : true
  })


const skillItemHtml = `<div class="skill-item">
  <div class="row">
      <div class="col-11">
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="">Tên năng lực</label>
                      <input type="text" name="home_about[skill][name][]" class="form-control" placeholder="Tên năng lực...">
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="">Giá trị</label>
                      <input type="text" name="home_about[skill][value][]" class="form-control ranger" />
                  </div>
              </div>
          </div>
      </div>
      <div class="col-1">
          <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
      </div>
  </div>
</div>`;

const addSkillObject = document.querySelector('.add-skill');
const skillObject = document.querySelector('.skill-wrapper');
if(addSkillObject!==null && skillObject!==null){
    addSkillObject.addEventListener('click',function(e){
        e.preventDefault();

        let skillItemHtmlNode = new DOMParser().parseFromString(skillItemHtml, 'text/html').querySelector('.skill-item');
 
        skillObject.appendChild(skillItemHtmlNode);
 
        openCkfinder();

        $('.ranger').ionRangeSlider({
            min     : 0,
            max     : 100,
            type    : 'single',
            step    : 1,
            postfix : ' %',
            prettify: false,
            hasGrid : true
        })
    })

    skillObject.addEventListener('click', function(e){
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){

            if (confirm('Bạn có chắc chắn muốn xoá?')){
                let skillItem = e.target;
                while (skillItem) {

                    skillItem = skillItem.parentElement;

                    if (skillItem.classList.contains('skill-item')) {
                        break;
                    }
                }

                if (skillItem !== null) {
                    skillItem.remove();
                }

            }
        }
    });
}

const partnerItemHtml = `<div class="partner-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Logo</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_partner_content[logo][]" placeholder="Đường dẫn ảnh...." value="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link</label>
                    <input type="text" name="home_partner_content[link][]" class="form-control" value="" placeholder="Link đối tác..." />
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
    </div>
</div>
</div><!-- End partner item-->`;

const addPartnerObject = document.querySelector('.add-partner');
const partnerObject = document.querySelector('.partner-wrapper');
if(addPartnerObject!==null && partnerObject!==null){
    addPartnerObject.addEventListener('click',function(e){
        e.preventDefault();

        let partnerItemHtmlNode = new DOMParser().parseFromString(partnerItemHtml, 'text/html').querySelector('.partner-item');
 
        partnerObject.appendChild(partnerItemHtmlNode);
 
        openCkfinder();

    })

    partnerObject.addEventListener('click', function(e){
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){

            if (confirm('Bạn có chắc chắn muốn xoá?')){
                let partnerItem = e.target;
                while (partnerItem) {

                    partnerItem = partnerItem.parentElement;

                    if (partnerItem.classList.contains('partner-item')) {
                        break;
                    }
                }

                if (partnerItem !== null) {
                    partnerItem.remove();
                }

            }
        }
    });
}

const teamItemHtml = `<div class="team-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên</label>
                    <input type="text" name="team_content[name][]" class="form-control" value="" placeholder="Tên..." />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Chức vụ</label>
                    <input type="text" name="team_content[position][]" class="form-control" value="" placeholder="Chức vụ..." />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Facebook</label>
                    <input type="text" name="team_content[facebook][]" class="form-control" value="" placeholder="Facebook..." />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" name="team_content[twitter][]" class="form-control" value="" placeholder="Twitter..." />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Linkedin</label>
                    <input type="text" name="team_content[linkedin][]" class="form-control" value="" placeholder="Linkedin..." />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Behance</label>
                    <input type="text" name="team_content[behance][]" class="form-control" value="" placeholder="Behance..." />
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Logo</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="team_content[image][]" placeholder="Đường dẫn ảnh...." value="">
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
    </div>
</div>
</div><!-- End team-item-->`;

const addTeamObject = document.querySelector('.add-team');
const teamObject = document.querySelector('.team-wrapper');
if(addTeamObject!==null && teamObject!==null){
    addTeamObject.addEventListener('click',function(e){
        e.preventDefault();

        let teamItemHtmlNode = new DOMParser().parseFromString(teamItemHtml, 'text/html').querySelector('.team-item');
 
        teamObject.appendChild(teamItemHtmlNode);
 
        openCkfinder();

    })

    teamObject.addEventListener('click', function(e){
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){

            if (confirm('Bạn có chắc chắn muốn xoá?')){
                let teamItem = e.target;
                while (teamItem) {

                    teamItem = teamItem.parentElement;

                    if (teamItem.classList.contains('team-item')) {
                        break;
                    }
                }

                if (teamItem !== null) {
                    teamItem.remove();
                }

            }
        }
    });
}