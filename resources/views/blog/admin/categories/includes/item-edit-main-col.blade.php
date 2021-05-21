<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input  name="title" value="{{ $item->title }}"
                                    id="title"
                                    type="text"
                                    class="form-control"
                                    minlenght="3"
                                    required>
                        </div>

                        <div class="form-group">
                            <label for="title">Идентификатор</label>
                            <input  name="slug" value="{{ $item->slug }}"
                                    id="title"
                                    type="text"
                                    class="form-control"
                                    minlenght="3">
                        </div>

                        <div class="form-group">
                            <label for="title">Родитель</label>
                            <select name="parent_id"
                                    id="parent_id"
                                    class="form-control"
                                    placeholder="Выберете категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->parent_id) selected @endif>
                                        {{-- {{ $categoryOption->id }}. {{ $categoryOption->title }}--}}
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3">{{ old('description', $item->description) }}</textarea>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>