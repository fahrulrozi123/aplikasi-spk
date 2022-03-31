@extends('templates/template')
@section('header_title')
    NEWS
@endsection
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/master_data/news">News</a>
        </li>
        <li class="active">
            <strong>Edit News</strong>
        </li>
    </ol>

    <style>
        .ms-container .ms-list {
            width: 135px;
            height: 205px;
        }

        .post-save-changes {
            float: right;
        }

        @media screen and (max-width: 789px) {
            .post-save-changes {
                float: none;
                margin-bottom: 20px;
            }
        }

    </style>

    <form method="post" role="form">
        <div class="col-lg-12">

            <!-- Title and Publish Buttons -->
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="field-1" class="control-label">
                            <h5><b>NEWS TITLE</b></h5>
                        </label>
                        <input type="text" class="form-control input-lg" name="post_title"
                            placeholder="Our Latest Event, Described!" />
                    </div>
                </div>
                <div class="col-sm-2 post-save-changes">
                    <br><br>
                    <button type="button" class="btn btn-link btn-lg btn-block danger">
                        <b>Delete News</b>
                    </button>
                </div>
                <div class="col-sm-2 post-save-changes">
                    <br><br>
                    <button type="button" class="btn btn-blue btn-lg btn-block">
                        <b>PUBLISH</b>
                    </button>
                </div>
            </div>

            <br />

            <!-- CKEditor - Content Editor -->
            <div class="row">
                <div class="col-sm-12">
                    <form role="form" method="post">
                        <textarea class="form-control ckeditor">
                    {{-- &lt;h1&gt;&lt;img alt=&quot;Saturn V carrying Apollo 11&quot; class=&quot;right&quot; src=&quot;assets/images/sample.jpg&quot;/&gt; Apollo 11&lt;/h1&gt; &lt;p&gt;&lt;b&gt;Apollo 11&lt;/b&gt; was the spaceflight that landed the first humans, Americans &lt;a href=&quot;http://en.wikipedia.org/wiki/Neil_Armstrong&quot; title=&quot;Neil Armstrong&quot;&gt;Neil Armstrong&lt;/a&gt; and &lt;a href=&quot;http://en.wikipedia.org/wiki/Buzz_Aldrin&quot; title=&quot;Buzz Aldrin&quot;&gt;Buzz Aldrin&lt;/a&gt;, on the Moon on July 20, 1969, at 20:18 UTC. Armstrong became the first to step onto the lunar surface 6 hours later on July 21 at 02:56 UTC.&lt;/p&gt; &lt;p&gt;Armstrong spent about &lt;s&gt;three and a half&lt;/s&gt; two and a half hours outside the spacecraft, Aldrin slightly less; and together they collected 47.5 pounds (21.5&amp;nbsp;kg) of lunar material for return to Earth. A third member of the mission, &lt;a href=&quot;http://en.wikipedia.org/wiki/Michael_Collins_(astronaut)&quot; title=&quot;Michael Collins (astronaut)&quot;&gt;Michael Collins&lt;/a&gt;, piloted the &lt;a href=&quot;http://en.wikipedia.org/wiki/Apollo_Command/Service_Module&quot; title=&quot;Apollo Command/Service Module&quot;&gt;command&lt;/a&gt; spacecraft alone in lunar orbit until Armstrong and Aldrin returned to it for the trip back to Earth.&lt;/p&gt; &lt;h2&gt;Broadcasting and &lt;em&gt;quotes&lt;/em&gt; &lt;a id=&quot;quotes&quot; name=&quot;quotes&quot;&gt;&lt;/a&gt;&lt;/h2&gt; &lt;p&gt;Broadcast on live TV to a world-wide audience, Armstrong stepped onto the lunar surface and described the event as:&lt;/p&gt; &lt;blockquote&gt;&lt;p&gt;One small step for [a] man, one giant leap for mankind.&lt;/p&gt;&lt;/blockquote&gt; &lt;p&gt;Apollo 11 effectively ended the &lt;a href=&quot;http://en.wikipedia.org/wiki/Space_Race&quot; title=&quot;Space Race&quot;&gt;Space Race&lt;/a&gt; and fulfilled a national goal proposed in 1961 by the late U.S. President &lt;a href=&quot;http://en.wikipedia.org/wiki/John_F._Kennedy&quot; title=&quot;John F. Kennedy&quot;&gt;John F. Kennedy&lt;/a&gt; in a speech before the United States Congress:&lt;/p&gt; &lt;blockquote&gt;&lt;p&gt;[...] before this decade is out, of landing a man on the Moon and returning him safely to the Earth.&lt;/p&gt;&lt;/blockquote&gt; &lt;h2&gt;Technical details &lt;a id=&quot;tech-details&quot; name=&quot;tech-details&quot;&gt;&lt;/a&gt;&lt;/h2&gt; &lt;table align=&quot;right&quot; border=&quot;1&quot; bordercolor=&quot;#ccc&quot; cellpadding=&quot;5&quot; cellspacing=&quot;0&quot; style=&quot;border-collapse:collapse;margin:10px 0 10px 15px;&quot;&gt; &lt;caption&gt;&lt;strong&gt;Mission crew&lt;/strong&gt;&lt;/caption&gt; &lt;thead&gt; &lt;tr&gt; &lt;th scope=&quot;col&quot;&gt;Position&lt;/th&gt; &lt;th scope=&quot;col&quot;&gt;Astronaut&lt;/th&gt; &lt;/tr&gt; &lt;/thead&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt;Commander&lt;/td&gt; &lt;td&gt;Neil A. Armstrong&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Command Module Pilot&lt;/td&gt; &lt;td&gt;Michael Collins&lt;/td&gt; &lt;/tr&gt; &lt;tr&gt; &lt;td&gt;Lunar Module Pilot&lt;/td&gt; &lt;td&gt;Edwin &amp;quot;Buzz&amp;quot; E. Aldrin, Jr.&lt;/td&gt; &lt;/tr&gt; &lt;/tbody&gt; &lt;/table&gt; &lt;p&gt;Launched by a &lt;strong&gt;Saturn V&lt;/strong&gt; rocket from &lt;a href=&quot;http://en.wikipedia.org/wiki/Kennedy_Space_Center&quot; title=&quot;Kennedy Space Center&quot;&gt;Kennedy Space Center&lt;/a&gt; in Merritt Island, Florida on July 16, Apollo 11 was the fifth manned mission of &lt;a href=&quot;http://en.wikipedia.org/wiki/NASA&quot; title=&quot;NASA&quot;&gt;NASA&lt;/a&gt;&amp;#39;s Apollo program. The Apollo spacecraft had three parts:&lt;/p&gt; &lt;ol&gt; &lt;li&gt;&lt;strong&gt;Command Module&lt;/strong&gt; with a cabin for the three astronauts which was the only part which landed back on Earth&lt;/li&gt; &lt;li&gt;&lt;strong&gt;Service Module&lt;/strong&gt; which supported the Command Module with propulsion, electrical power, oxygen and water&lt;/li&gt; &lt;li&gt;&lt;strong&gt;Lunar Module&lt;/strong&gt; for landing on the Moon.&lt;/li&gt; &lt;/ol&gt; &lt;p&gt;After being sent to the Moon by the Saturn V&amp;#39;s upper stage, the astronauts separated the spacecraft from it and travelled for three days until they entered into lunar orbit. Armstrong and Aldrin then moved into the Lunar Module and landed in the &lt;a href=&quot;http://en.wikipedia.org/wiki/Mare_Tranquillitatis&quot; title=&quot;Mare Tranquillitatis&quot;&gt;Sea of Tranquility&lt;/a&gt;. They stayed a total of about 21 and a half hours on the lunar surface. After lifting off in the upper part of the Lunar Module and rejoining Collins in the Command Module, they returned to Earth and landed in the &lt;a href=&quot;http://en.wikipedia.org/wiki/Pacific_Ocean&quot; title=&quot;Pacific Ocean&quot;&gt;Pacific Ocean&lt;/a&gt; on July 24.&lt;/p&gt; &lt;hr/&gt; &lt;p style=&quot;text-align: right;&quot;&gt;&lt;small&gt;Source: &lt;a href=&quot;http://en.wikipedia.org/wiki/Apollo_11&quot;&gt;Wikipedia.org&lt;/a&gt;&lt;/small&gt;&lt;/p&gt; --}}
                </textarea>
                    </form>
                    {{-- <textarea class="form-control wysihtml5" rows="18" data-stylesheet-url="{{ asset('css/wysihtml5-color.css') }}" name="post_content" id="post_content"></textarea> --}}
                </div>
            </div>

            <br />

            <!-- Metaboxes -->
            <div class="row">

                <!-- Metabox :: Featured Image -->
                <div class="col-sm-5">

                    <div class="panel panel-primary panel-shadow" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title">
                                News Photos
                            </div>

                            {{-- <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div> --}}
                        </div>

                        <div class="panel-body">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 450px; max-height: 250px;"
                                    data-trigger="fileinput">
                                    <img src="{{ asset('/images/dashboard/size-image.png') }}" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"
                                    style="max-width: 320px; max-height: 160px"></div>
                                <div>
                                    <span class="btn btn-file">
                                        <span class="btn btn-blue fileinput-new"><i class="entypo-upload"></i> Browse
                                            File</span>
                                        <span class="btn btn-white fileinput-exists">Change</span>
                                        <input type="file" name="..." accept="image/*">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Metabox :: Publish Settings -->
                <div class="col-sm-3">

                    <div class="panel panel-primary panel-shadow" data-collapsed="0">

                        <div class="panel-heading">
                            <div class="panel-title">
                                Publish Settings
                            </div>

                            {{-- <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div> --}}
                        </div>

                        <div class="panel-body">

                            <div class="checkbox checkbox-replace color-primary">
                                <input type="checkbox" id="chk-1">
                                <label>Stick this news</label>
                            </div>

                            <br />

                            <p>Post Status</p>
                            <select name="test" class="selectboxit">
                                <optgroup label="Post Status">
                                    <option value="1">Publish</option>
                                    <option value="2">Private</option>
                                    <option value="3">Protected</option>
                                    <option value="4">Scheduled</option>
                                </optgroup>
                            </select>

                            <br />

                            <p>Publish Date</p>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" value="Wed, 04 Feb 2020"
                                    data-format="D, dd MM yyyy">

                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Metabox :: Categories -->
                <div class="col-sm-4">

                    {{-- <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Categories
                    </div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <select multiple="multiple" name="categories[]" class="form-control multi-select">
                        <option value="elem_1">Art</option>
                        <option value="elem_2" selected>Entertainment</option>
                        <option value="elem_3">Sports</option>
                        <option value="elem_4">Gaming</option>
                        <option value="elem_5" selected>Abstraction</option>
                        <option value="elem_6">Nature</option>
                        <option value="elem_7">Summer</option>
                        <option value="elem_8">Adventures</option>
                        <option value="elem_9">Movies</option>
                        <option value="elem_10">Music</option>
                        <option value="elem_11">Technology</option>
                    </select>

                </div> --}}

                </div>

            </div>

            <div class="clear"></div>

            {{-- <!-- Metabox :: Tags -->
        <div class="col-sm-12">

            <div class="panel panel-primary panel-shadow" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Tags
                    </div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <p>Add Post Tags</p>
                    <input type="text" value="weekend,friday,happy,awesome,chill,healthy" class="form-control tagsinput" />

                </div>

            </div>

        </div> --}}

        </div>

        </div>
    </form>
@endsection
